#include "cluster.h"
#include "kfile.h"
#include <stdio.h>
#include <string.h>

Cluster::Cluster() {
	level = 0;

	index = new ClusterNo[ClusterSize / 4];
	for (int i = 0; i < ClusterSize / 4; i++) {
		index[i] = 0;
	}
}

Cluster::~Cluster() {
	delete[] index;
}