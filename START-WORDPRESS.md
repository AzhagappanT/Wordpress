# Starting Your WordPress Banking Application

##Step 1: Start the WordPress Server

Run this command in PowerShell:

```powershell
cd "C:\Users\ADMIN\OneDrive\Desktop\Abi\Abi\Wordpress"
C:\Users\ADMIN\AppData\Local\Programs\phpenv\versions\8.2.27+1\bin\win64\php.exe -S localhost:8000 -t wordpress
```

## Step 2: Open WordPress in Browser

Go to: **http://localhost:8000**

## Step 3: Complete WordPress Installation

1. Fill in:
   - Site Title: **A Bank**
   - Username: **admin**
   - Password: **password**
   - Email: **admin@local.test**
2. Click **Install WordPress**

## Step 4: Activate the Banking Application Theme

1. Go to **Appearance** → **Themes**
2. Find "Banking Application"
3. Click **Activate**

## Step 5: Test Your Application!

Open: **http://localhost:8000**

You should see your Banking Application running!

---

**Everything is ready - I've already:**
- ✅ Downloaded WordPress
- ✅ Deployed Banking Application theme
- ✅ Configured SQLite database
- ✅ Set up wp-config.php

**Just run that one command and it's live!** 🚀
