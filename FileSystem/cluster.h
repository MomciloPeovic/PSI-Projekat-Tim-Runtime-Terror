#ifndef _cluster_h_
#define _cluster_h_

#include "testprimer.h"
#include "part.h"
#include "kfs.h"


class Cluster {
public:
	Cluster();
	~Cluster();

	int level;

	ClusterNo *index;
};

#endif
