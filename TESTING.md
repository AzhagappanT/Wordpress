# Testing Your WordPress Banking Project

Since this is a WordPress theme, it requires a running WordPress environment to test.

## Step 1: Start Local & Create Site
1. Open the **Local** application on your computer.
2. **IMPORTANT: YOU MUST CREATE A SITE FIRST**
   - I checked your computer and **no site exists**.
   - Click the **+** button in Local (bottom left).
   - Name it `Banking-Demo`.
   - Finish the setup.
   - **Only then** can I deploy the project.
3. Ensure your site is **Running** (green dot).

## Step 2: Deploy the Theme
1. Right-click your site in Local and select **"Open Site Shell"**.
2. Run the following commands in the shell:

```powershell
cd "c:\Users\ADMIN\OneDrive\Desktop\Abi\Abi\Wordpress"
.\deploy.ps1
```

3. When prompted for a path:
   - Go back to Local app.
   - Right-click your site -> **"Go to Site Folder"**.
   - Open `app` -> `public`.
   - Copy the address from the top bar.
   - Paste it into the shell and press Enter.

## Step 3: Verify in Browser
1. Click **"Open Site"** in Local.
2. You should see the Banking Application login page.
3. Login with:
   - **Username:** `demo`
   - **Password:** `demo` (or whatever you set for your WP admin)

## Step 4: Test Features
- **Dashboard:** Check if your balance shows ₹1,00,000.00.
- **Transactions:** Check if you see recent transactions.
- **Transfer:** Try sending money to a mobile number.

## Troubleshooting
- If you see a different theme, go to **WP Admin** -> **Appearance** -> **Themes** and activate "Banking Application".
- If pages are missing, check if the "Banking Theme Auto-Setup" plugin is active in **Plugins** -> **Must-Use**.
