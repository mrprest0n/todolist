@ECHO OFF
taskkill /f /IM nginx.exe
taskkill /f /IM php-cgi.exe
net stop MySQL
pause