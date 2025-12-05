@echo off
echo Starting Christmas Landing Website...
echo.
echo Open http://localhost:8000 in your browser.
echo.
cd /d "%~dp0"
C:\Users\ADMIN\AppData\Local\Programs\phpenv\versions\8.2.27+1\bin\win64\php.exe -S localhost:8000 -t wordpress
pause
