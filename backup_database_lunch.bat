set t=%time:~0,2%_%time:~3,2%
set fname=lunch_%date:~-10,2%-%date:~-7,2%-%date:~-4,4%__%t%.sql
cd \xampp\mysql\bin
mysqldump.exe -uclayton -pFluffy3540# -hlocalhost lunch > c:\xampp\htdocs\lunch/%fname%
