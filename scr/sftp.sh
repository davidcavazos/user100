USER='user100'
PASS='G4igTrtIX5'

cd ..
sftp $USER@148.202.152.110 << ! 
	cd /www
	rm *
	rmdir *
	quit

!
