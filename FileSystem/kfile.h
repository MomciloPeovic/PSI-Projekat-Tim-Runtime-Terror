#ifndef _kfile_h_
#define _kfile_h_

#include "fs.h"
#include "file.h"
#include "directory.h"

class File;
class Entry;
class Section;

class KernelFile {
public:
	char write(BytesCnt, char *buffer);
	BytesCnt read(BytesCnt, char *buffer);
	char seek(BytesCnt);
	BytesCnt filePos();	
	char eof();	
	BytesCnt getFileSize();
	char truncate();

	BytesCnt position;
	BytesCnt size;

	//atributes
	char buff[32];
	char buffer[2 * 1024 * 1024];
	char mode;

	//clusters
	unsigned long index1;
	unsigned long index2;
	unsigned long index3;
	unsigned long index4;
	ClusterNo firstIndex;
	ClusterNo current;
	Cluster *clusters;

	friend class FS;
	friend class KernelFS;
	KernelFile();  //objekat fajla se može kreirati samo otvaranjem   
};

#endif