# WordPress Banking Application - Setup Guide

## For HR Review

This Banking Application is a fully functional WordPress theme demonstrating modern banking features.

## Quick Demo (No Installation)

**Fastest way to see the project:**
1. Open the `demo` folder
2. Double-click `index.html`
3. Login with: **username:** `demo` **password:** `demo`

This HTML demo works instantly without any installation!

## WordPress Setup Instructions

To run as a full WordPress project:

### Prerequisites
- Local by Flywheel (WordPress development tool)
- OR XAMPP/WAMP/MAMP

### Method 1: Using Local (Recommended)

1. **Open Local** (already installed on this system)
   - Launch "Local" from Start Menu

2. **Create a New Site**
   - Click the "+" button
   - Site Name: `Banking-Demo`
   - Environment: Preferred or Custom (PHP 7.4+)
   - Username: `admin`, Password: your choice

3. **Deploy the Theme**
   - Right-click on PowerShell and run `deploy.ps1`
   - OR manually copy `BankingApplication` folder to:
     `C:\Users\ADMIN\Local Sites\Banking-Demo\app\public\wp-content\themes\`

4. **Activate the Theme**
   - Click "WP Admin" in Local
   - Go to Appearance → Themes
   - Activate "Banking Application"

5. **Create Pages**
   - Create pages: Login, Dashboard, Transfer
   - Assign templates to each page

### Method 2: Using XAMPP

1. Install XAMPP
2. Copy `BankingApplication` to: `C:\xampp\htdocs\wordpress\wp-content\themes\`
3. Access via: `http://localhost/wordpress`

## Project Structure

```
├── demo/                    # Standalone HTML demo (works instantly)
│   ├── index.html
│   ├── login.html
│   ├── dashboard.html
│   ├── transactions.html
│   └── transfer.html
│
├── BankingApplication/      # WordPress Theme
│   ├── style.css           # Theme info
│   ├── functions.php       # Backend logic
│   ├── header.php
│   ├── footer.php
│   ├── index.php
│   ├── assets/
│   └── page-templates/
│
├── README.md               # This file
└── deploy.ps1             # Automated deployment script
```

## Features

- ✅ User Authentication
- ✅ Account Dashboard with Balance
- ✅ Money Transfer (Account Number & Mobile)
- ✅ Transaction History with Pagination
- ✅ Responsive Design
- ✅ Indian Banking Standards (₹ INR)

## Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP, WordPress
- **Database:** MySQL (via WordPress)
- **Styling:** Custom CSS with CSS Variables

## Demo Credentials

- **Username:** demo
- **Password:** demo

## Author

**Created by:** Azhagappan  
**Project:** Banking Application  
**Version:** 1.0

## GitHub Repository

https://github.com/AzhagappanT/Wordpress

---

**For immediate review, use the HTML demo in the `demo` folder!**
