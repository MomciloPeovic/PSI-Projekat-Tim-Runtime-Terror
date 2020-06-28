#ifndef _kfs_h_
#define _kfs_h_

#include "fs.h"
#include "testprimer.h"
#include <bitset>

class FS;
class Partition;
class File;
class KernelFile;
class Directory;

class KernelFS {
public:  ~KernelFS();
		 static char mount(Partition* partition); //montira particiju
												  // vraca 0 u slucaju neuspeha ili 1 u slucaju uspeha   
		 static char unmount();  //demontira particiju
								 // vraca 0 u slucaju neuspeha ili 1 u slucaju uspeha   
		 static char format(); //formatira particiju;                 
							   // vraca 0 u slucaju neuspeha ili 1 u slucaju uspeha   
		 static FileCnt readRootDir();
		 // vraca -1 u slucaju neuspeha ili broj fajlova u slucaju uspeha    
		 static char doesExist(char* fname); //argument je naziv fajla sa                                        
											 //apsolutnom putanjom    
		 static File* open(char* fname, char mode);
		 static char deleteFile(char* fname);

		 //Indexing
		 static ClusterNo dir;
		 static Directory *directory;

		 //BitVector
		 static int *bitVector;
		 static ClusterNo firstClusterAfterBV;
		 static ClusterNo firstClusterAfterDir;

protected:
	KernelFS();

	friend class FS;
};

#endif