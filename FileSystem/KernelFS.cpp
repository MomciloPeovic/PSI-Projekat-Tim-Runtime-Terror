#include "kfs.h"
#include "kfile.h"
#include "directory.h"

Directory *KernelFS::directory;
int *KernelFS::bitVector;
KernelFile **KernelFS::files;
int KernelFS::top;

ClusterNo KernelFS::dir;
ClusterNo KernelFS::firstClusterAfterBV;
ClusterNo KernelFS::firstClusterAfterDir;

HANDLE semMount = CreateSemaphore(NULL, 1, 32, NULL);


KernelFS::KernelFS() {
	dir = 0;
	top = 0;
	bitVector = new int[partition->getNumOfClusters()];
	for (unsigned long i = 0; i < partition->getNumOfClusters(); i++) bitVector[i] = 0;
	files = new KernelFile*[partition->getNumOfClusters() / 64];
}

KernelFS::~KernelFS() {
	delete[] bitVector;
}

char KernelFS::mount(Partition *partition) {
	if (partition != nullptr) wait(semMount);
	::partition = partition;
	return 1;
}

char KernelFS::unmount() {
	::partition = nullptr;
	signal(semMount);
	return 0;
}

char KernelFS::format() {
	char buffer[3000];

	for (int i = 0; i < 2048; i++)
		buffer[i] = '0';

	for (unsigned int i = 0; i < partition->getNumOfClusters(); i++) 
		partition->writeCluster(i, buffer);

	firstClusterAfterBV = partition->getNumOfClusters() / (ClusterSize * 8) + 1; // 1

	directory = new Directory();
	dir = directory->clusters[directory->index2].index[directory->index3];

	firstClusterAfterDir = firstClusterAfterBV + partition->getNumOfClusters() / 64 + directory->numOfClusters + 1; // 19
	return 0;
}

FileCnt KernelFS::readRootDir() {
	if (directory == nullptr) return -1;
	return directory->numOfFiles;
}

char KernelFS::doesExist(char *fname) {
	ClusterNo cluster = directory->getNextCluster();

	char buffer[2048], buff[32], c;
	directory->getBuffer(buff, fname);
	partition->readCluster(cluster, buffer);
	for (int i = 0; i < directory->numOfFiles; i++) {
		c = '1';
		for (int j = 0; j < 11; j++) if (buff[j] != buffer[i * 32 + j]) {
			c = 0;
			break;
		}
		if (c == '1') return c;
	}
	return c;
}

File *KernelFS::open(char *fname, char mode) {
	char buff[32];
	directory->getBuffer(buff, fname);
	if (mode == 'w') {
		File *file = new File();
		files[top++] = file->myImpl;
		long seek = -1;

		if (doesExist(fname)) {
			char buffer[2048], c;
			partition->readCluster(directory->getNextCluster(), buffer);
			for (int i = 0; i < directory->numOfFiles; i++) {
				c = '1';
				for (int j = 0; j < 11; j++) if (buff[j] != buffer[i * 32 + j]) {
					c = '0';
					break;
				}
				if (c == '1') {
					seek = i * 32;
					break;
				}
			}
		}

		ClusterNo cluster = directory->getNextCluster();
		if (seek == -1) {
			seek = directory->getNextFree();
			for (unsigned int i = firstClusterAfterDir; i < partition->getNumOfClusters(); i++)
				if (bitVector[i] == 0) {
					file->myImpl->firstIndex = i;
					bitVector[i] = 1;

					char index[4];
					for (int i = 0; i < 4; i++) index[i] = '0';
					itoa(i, index, 10);
					for (int i = 0; i < 4; i++) if (index[i] == '\0') index[i] = '0';
					for (int i = 12; i < 16; i++) buff[i] = index[i - 12];
					break;
				}
		}

		char buffer[2048];
		partition->readCluster(cluster, buffer);
		for (int i = 0; i < 32; i++) buffer[seek++] = buff[i];
		partition->writeCluster(cluster, buffer);

		file->myImpl->mode = 'w';
		directory->numOfFiles++;
		bitVector[cluster] = 1;

		return file;
	} else if (mode == 'r') {
		if (!doesExist(fname)) return 0;

		File *file = new File();

		char buffer[2048], c;
		partition->readCluster(directory->getNextCluster(), buffer);
		for (int i = 0; i < directory->numOfFiles; i++) {
			c = '1';
			for (int j = 0; j < 11; j++) if (buff[j] != buffer[i * 32 + j]) {
				c = '0';
				break;
			}
			if (c == '1') break;
		}
		
		for (int i = 12; i < 16; i++) buff[i] = buffer[i];
		ClusterNo ind;
		char index[4];
		for (int i = 0; i < 4; i++) index[i] = '0';
		for (int i = 12; i < 16; i++) index[i - 12] = buff[i];
		for (int i = 0; i < 4; i++) if (index[i] == '0') index[i] = '\0';
		ind = atoi(index);
		file->myImpl->firstIndex = ind;

		for (int i = 0; i < top; i++) {
			if (files[i]->firstIndex == ind) {
				file->myImpl = files[i];
				break;
			}
		}
		file ->myImpl->mode = 'r';
		file->myImpl->position = 0;
		file->myImpl->index1 = 0;
		file->myImpl->index2 = 1;
		file->myImpl->index3 = 0;
		file->myImpl->index4 = 0;

		return file;
	}
	else {
		if (!doesExist(fname)) return 0;

		File *file = new File();

		char buffer[2048], c;
		partition->readCluster(directory->getNextCluster(), buffer);
		for (int i = 0; i < directory->numOfFiles; i++) {
			c = '1';
			for (int j = 0; j < 11; j++) if (buff[j] != buffer[i * 32 + j]) {
				c = '0';
				break;
			}
			if (c == '1') break;
		}

		for (int i = 12; i < 16; i++) buff[i] = buffer[i];
		ClusterNo ind;
		char index[4];
		for (int i = 0; i < 4; i++) index[i] = '0';
		for (int i = 12; i < 16; i++) index[i - 12] = buff[i];
		for (int i = 0; i < 4; i++) if (index[i] == '0') index[i] = '\0';
		ind = atoi(index);
		file->myImpl->firstIndex = ind;

		for (int i = 0; i < top; i++) {
			if (files[i]->firstIndex == ind) {
				file->myImpl = files[i];
				break;
			}
		}

		file->myImpl->mode = 'a';

		return file;
	}
	return 0;
}

char KernelFS::deleteFile(char *fname) {

	return '0';
}
