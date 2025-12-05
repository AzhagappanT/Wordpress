# Banking Application - WordPress Project

## What's in this folder

This `wordpress` folder is set up to run your Banking Application as a WordPress theme.

## How to use

**Option 1: Quick Demo (Recommended)**
The wordpress/index.php currently redirects to the working HTML demo.
Just run: `start-server.bat` and open http://localhost:8080

**Option 2: Full WordPress Installation**
For a complete WordPress setup:
1. Download WordPress from https://wordpress.org/latest.zip
2. Extract here to replace this folder
3. Copy `BankingApplication` theme to `wp-content/themes/`
4. Run setup at http://localhost:8080

## Current Setup

- Banking Application theme is ready in the parent folder
- HTML demo works perfectly (in `../demo/`)
- Server script ready (`start-server.bat`)

## To test now

Run this in PowerShell:
```powershell
cd wordpress
C:\Users\ADMIN\AppData\Local\Programs\phpenv\versions\php-8.2.27+1\bin\win32\php.exe -S localhost:8080
```

Then visit: http://localhost:8080
