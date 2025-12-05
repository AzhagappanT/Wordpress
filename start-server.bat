@echo off
echo ========================================
echo Banking Application Server
echo ========================================
echo.
echo Starting PHP server on localhost:8080...
echo.
echo IMPORTANT: Keep this window open!
echo Press Ctrl+C to stop the server.
echo.
echo Once started, open: http://localhost:8080
echo ========================================
echo.

cd /d "%~dp0demo"
"C:\Users\ADMIN\AppData\Local\Programs\phpenv\versions\php-8.2.27+1\bin\win32\php.exe" -S localhost:8080

pause
