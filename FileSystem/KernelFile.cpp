#include "kfile.h"
#include <stdlib.h>


KernelFile::KernelFile() {
	mode = 'r';
	index1 = 0;
	index2 = 1;
	index3 = 0;
	index4 = 0;
	firstIndex = 0;
	current = 0;
	size = 0;

	clusters = new Cluster[partition->getNumOfClusters() - (partition->getNumOfClusters() / 64 + partition->getNumOfClusters() / (ClusterSize * 8) + 3)];
}

char KernelFile::write(BytesCnt count, char *b) {
	if (mode == 'r') return '0';

	if (clusters[index2].index[index4] == 0)
		for (unsigned int i = KernelFS::firstClusterAfterDir; i < partition->getNumOfClusters(); i++)
			if (KernelFS::bitVector[i] == 0) {
				if (clusters[index1].index[index3] == 0) {
					if (clusters[index1].level == 0) clusters[index1].level = 1;

					clusters[index1].index[index3] = i;
					if (index3 == ClusterSize / 4) index1++;
					KernelFS::bitVector[i] = 1;
				}
				else {
					if (clusters[index2].level == 0) clusters[index2].level = 2;

					clusters[index2].index[index4] = i;
					current = i;
					if (index4 == ClusterSize / 4) index2++;
					if (index2 == ClusterSize / 4) index3++;
					KernelFS::bitVector[i] = 1;
					break;
				}
			}
	char buf[2048];
	partition->readCluster(current, buf);
	buf[position++ % 2048] = b[0];
	if (position % 2048 == 0) index4++;
	partition->writeCluster(current, buf);
	size++;

	return '0';
}

BytesCnt KernelFile::read(BytesCnt count, char *buffer) {
	if (position == size && mode != 'r') return 0;



	return 0;
}


char KernelFile::seek(BytesCnt seek) {

	return '0';
}

BytesCnt KernelFile::filePos() {
	return position;
}

char KernelFile::eof() {
	if (position == size)
		return '1';
	return '0';
}

BytesCnt KernelFile::getFileSize() {
	return size;
}

char KernelFile::truncate() {

	return '0';
}