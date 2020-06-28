#ifndef _directory_h_
#define _directory_h_

#include "part.h"
#include "cluster.h"
#include "testprimer.h"
#include "kfs.h"

class Partition;

class Directory
{
public:
	Directory();
	~Directory();

	unsigned long getNextFree();
	ClusterNo getNextCluster();
	char *getBuffer(char *, char *);

	unsigned long index1;
	unsigned long index2;
	unsigned long index3;
	FileCnt numOfFiles;
	ClusterNo numOfClusters;
	unsigned long nextFree;

	Cluster *clusters;

};

#endif
