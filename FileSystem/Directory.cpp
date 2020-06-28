#include "directory.h"

Directory::Directory() {
	numOfFiles = 0;
	nextFree = 0;
	index1 = 0;
	index2 = 1;
	index3 = 0;

	ClusterNo numOfIndex1, numOfIndex2;
	numOfIndex1 = partition->getNumOfClusters() / ( 64 * ClusterSize / 4 * ClusterSize / 4) + 1;
	numOfIndex2 = partition->getNumOfClusters() / ( 64 * ClusterSize / 4) + 1;
	numOfClusters = numOfIndex1 + numOfIndex2;
	clusters = new Cluster[numOfClusters];

	for (ClusterNo i = 0; i < numOfIndex1; i++) clusters[i].level = 1;
	for (ClusterNo i = numOfIndex1; i < numOfClusters; i++) clusters[i].level = 2;
	for (ClusterNo i = 0; i < numOfIndex2; i++) clusters[index1].index[i] = KernelFS::firstClusterAfterBV + numOfIndex1 + i;
	clusters[index2].index[index3] = clusters[index1].index[0] + 1;
}

Directory::~Directory() {
	delete[] clusters;
}

unsigned long Directory::getNextFree(){
	nextFree += 32;
	return nextFree - 32;
}

ClusterNo Directory::getNextCluster() {
	if (nextFree == 2048) {
		index3++;
		clusters[index2].index[index3] = clusters[index2].index[index3 - 1] + 1;
	}
	return clusters[index2].index[index3];
}

char *Directory::getBuffer(char *buffer, char *fname) {
	char name[8];
	char ext[3];
	int i = FNAMELEN + 1;
	int j = FEXTLEN - 1;
	while (fname[i] != '.') {
		ext[j] = fname[i];
		i--;
		j--;
	}
	for (int i = j; i >= 0; i--) ext[i] = ' ';
	i--;
	j = FNAMELEN - 1;
	while (fname[i] != '/') {
		name[j] = fname[i];
		i--;
		j--;
	}
	for (int i = j; i >= 0; i--) {
		name[i] = ' ';
	}
	for (int i = 0; i < 8; i++) buffer[i] = name[i];
	for (int i = 8; i < 11; i++) buffer[i] = ext[i - 8];
	for (int i = 11; i < 32; i++) buffer[i] = '0';
	
	return buffer;
}
