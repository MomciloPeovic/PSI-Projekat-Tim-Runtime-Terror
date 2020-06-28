#include"testprimer.h"

static char threadName[] = "Nit1";

DWORD WINAPI nit1run(){
	wait(mutex); partition=new Partition((char *)"p1.ini"); signal(mutex);
	wait(mutex); cout<<threadName<<": Kreirana particija"<<endl; signal(mutex);
	FS::mount(partition);
	wait(mutex); cout<<threadName<<": Montirana particija"<<endl; signal(mutex);
	FS::format();
	wait(mutex); cout<< threadName << ": Formatirana particija"<<endl; signal(mutex);
	signal(sem12); //signalizira niti 2
	wait(mutex); cout << threadName << ": wait 1" << endl; signal(mutex);
	//wait(sem21); //ceka nit1

	//Testiranje pre javnog testa
	char filepath[] = "/fajl1.dat";
	File *f = FS::open(filepath, 'w');
	wait(mutex); cout << threadName << ": Kreiran fajl '" << filepath << "'" << endl; signal(mutex);
	char filepath1[] = "/fajl2.dat";
	File *f1 = FS::open(filepath1, 'w');
	wait(mutex); cout << threadName << ": Kreiran fajl '" << filepath1 << "'" << endl; signal(mutex);

	{
		char filepath[]="/fajl1.dat";
		File *f = FS::open(filepath, 'a');
		char *buff = new char[2048];
		wait(mutex); cout<< threadName << ": Kreiran fajl '"<< filepath <<"'"<<endl; signal(mutex);
		for (int i = 0; i < ulazSize; i++) {
			f->write(ulazSize, &ulazBuffer[i]);
		}
		wait(mutex); cout<< threadName << ": Prepisan sadrzaj 'ulaz.dat' u '" << filepath << "'"<<endl; signal(mutex);
		delete f;
		wait(mutex); cout<< threadName << ": zatvoren fajl '" << filepath << "'"<<endl; signal(mutex);
	}	

	{
		char filepath[] = "/fajl1.dat";
		File *f = FS::open(filepath, 'r');
		wait(mutex); cout << threadName << ": Otvoren fajl " << filepath << "" << endl; signal(mutex);
		ofstream fout("izlaz1.dat", ios::out | ios::binary);
		char *buff = new char[f->getFileSize()];
		for (unsigned int i = 0; i < f->getFileSize(); i++) {
			f->read(f->getFileSize(), &buff[i]);
		}
		fout.write(buff, f->getFileSize());
		wait(mutex); cout << threadName << ": Upisan '" << filepath << "' u fajl os domacina 'izlaz1.dat'" << endl; signal(mutex);
		delete[] buff;
		fout.close();
		delete f;
		wait(mutex); cout << threadName << ": Zatvoren fajl " << filepath << "" << endl; signal(mutex);
	}
	/*
	{
		char filepath[]="/fajl1.dat";
		File *f=FS::open(filepath,'w');
		wait(mutex); cout<< threadName << ": Kreiran fajl '"<< filepath <<"'"<<endl; signal(mutex);
		f->write(ulazSize,ulazBuffer);
		wait(mutex); cout<< threadName << ": Prepisan sadrzaj 'ulaz.dat' u '" << filepath << "'"<<endl; signal(mutex);
		delete f;
		wait(mutex); cout<< threadName << ": zatvoren fajl '" << filepath << "'"<<endl; signal(mutex);
	}	

	{
		File *src,*dst;
		char filepath[]="/fajl1.dat";
		src=FS::open(filepath,'r');
		src->seek(src->getFileSize()/2);//pozicionira se na pola fajla
		wait(mutex); cout<< threadName << ": Otvoren fajl '" << filepath << "' i pozicionirani smo na polovini"<<endl; signal(mutex);
		char filepath1[]="/fajll5.dat";
		dst=FS::open(filepath1,'w');
		wait(mutex); cout<< threadName << ": Otvoren fajl '" << filepath1 << "'"<<endl; signal(mutex);
		char c;
		while(!src->eof()){
			src->read(1,&c);
			dst->write(1,&c);
		}
		wait(mutex); cout<< threadName << ": Prepisana druga polovina '" << filepath << "' u '" << filepath1 << "'"<<endl; signal(mutex);
		delete dst;
		wait(mutex); cout<< threadName << ": Zatvoren fajl '" << filepath1 << "'"<<endl; signal(mutex);
		delete src;
		wait(mutex); cout<< threadName << ": Zatvoren fajl '" << filepath << "'"<<endl; signal(mutex);
	}
	signal(sem12); // signalizira niti 2
	wait(mutex); cout<< threadName << ": wait 2"<<endl; signal(mutex);
	wait(sem21);//ceka nit1


	{
		File *src, *dst;
		char filepath[] = "/fajl25.dat";
		dst = FS::open(filepath, 'a');
		wait(mutex); cout << threadName << ": Otvoren fajl '" << filepath << "'" << endl; signal(mutex);
		char filepath1[] = "/fajll5.dat";
		src = FS::open(filepath1, 'r');
		wait(mutex); cout << threadName << ": Otvoren fajl '" << filepath1 << "'" << endl; signal(mutex);
		char c;
		while (!src->eof()) {
			src->read(1, &c);
			dst->write(1, &c);
		}
		wait(mutex); cout << threadName << ": Prepisana druga polovina '" << filepath << "' u '" << filepath1 << "'" << endl; signal(mutex);
		delete dst;
		wait(mutex); cout << threadName << ": Zatvoren fajl '" << filepath1 << "'" << endl; signal(mutex);
		delete src;
		wait(mutex); cout << threadName << ": Zatvoren fajl '" << filepath << "'" << endl; signal(mutex);
	}
	signal(sem12); // signalizira niti 2

	wait(mutex); cout<< threadName << ": Zavrsena!"<<endl; signal(mutex);*/
	signal(semMain);
	return 0;
}