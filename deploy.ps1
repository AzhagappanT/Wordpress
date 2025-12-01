$source = "$PSScriptRoot\BankingTheme"
Write-Host "This script will deploy the BankingTheme and set up your site automatically."
Write-Host "1. Ensure your Local site is RUNNING."
Write-Host "2. Right-click your site in Local -> 'Go to Site Folder'."
Write-Host "3. Navigate to 'app' -> 'public'."
Write-Host "4. Copy that path and paste it below."
Write-Host ""

$publicDir = Read-Host "Paste the 'public' folder path here"

if ([string]::IsNullOrWhiteSpace($publicDir)) {
    Write-Host "No path provided. Exiting." -ForegroundColor Yellow
    exit
}

if (-not (Test-Path $publicDir)) {
    Write-Host "Error: The path '$publicDir' does not exist." -ForegroundColor Red
    exit
}

$themeDir = Join-Path -Path $publicDir -ChildPath "wp-content\themes\BankingTheme"
$muPluginsDir = Join-Path -Path $publicDir -ChildPath "wp-content\mu-plugins"

# 1. Deploy Theme
Write-Host "Copying theme to $themeDir..."
try {
    if (-not (Test-Path $themeDir)) { New-Item -ItemType Directory -Force -Path $themeDir | Out-Null }
    Copy-Item -Path "$source\*" -Destination $themeDir -Recurse -Force
    Write-Host "Theme files copied." -ForegroundColor Green
}
catch {
    Write-Host "Error copying theme: $_" -ForegroundColor Red
    exit
}

# 2. Create Auto-Setup MU Plugin
Write-Host "Creating auto-setup plugin..."
if (-not (Test-Path $muPluginsDir)) { New-Item -ItemType Directory -Force -Path $muPluginsDir | Out-Null }

$setupCode = @"
<?php
/**
 * Plugin Name: Banking Theme Auto-Setup
 * Description: Automatically activates theme and creates pages.
 */

add_action('init', function() {
    // 1. Activate Theme
    if (get_option('stylesheet') !== 'BankingTheme') {
        switch_theme('BankingTheme');
    }

    // 2. Create Pages
    \$pages = array(
        'Login' => 'page-templates/page-login.php',
        'Dashboard' => 'page-templates/page-dashboard.php',
        'Transfer' => 'page-templates/page-transfer.php'
    );

    foreach (\$pages as \$title => \$template) {
        \$page_check = get_page_by_title(\$title);
        if (!isset(\$page_check->ID)) {
            \$new_page_id = wp_insert_post(array(
                'post_title' => \$title,
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_content' => ''
            ));
            if (\$new_page_id && !is_wp_error(\$new_page_id)) {
                update_post_meta(\$new_page_id, '_wp_page_template', \$template);
            }
        } else {
             // Ensure template is set even if page exists
             update_post_meta(\$page_check->ID, '_wp_page_template', \$template);
        }
    }
});
"@

$setupFile = Join-Path -Path $muPluginsDir -ChildPath "banking-setup.php"
Set-Content -Path $setupFile -Value $setupCode

Write-Host "Auto-setup plugin created." -ForegroundColor Green
Write-Host "---------------------------------------------------"
Write-Host "DONE! Now verify your site:"
Write-Host "1. Open your site in the browser."
Write-Host "2. The theme should be active."
Write-Host "3. Pages 'Login', 'Dashboard', and 'Transfer' should exist."
Write-Host "---------------------------------------------------"
