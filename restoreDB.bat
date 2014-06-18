@echo off
setlocal
:PROMPT
SET /P AREYOUSURE=Are you sureou want to restore the database? It will overwrite the current database! (Y/[N])?
IF /I "%AREYOUSURE%" NEQ "Y" GOTO END
"C:\Program Files\MySQL\MySQL Server 5.6\bin\mysql.exe" -ucloudmsg -p2T^^p%%AE! -hlocalhost panachebeadco_new < db.sql
:END
endlocal y