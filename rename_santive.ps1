$files = Get-ChildItem -Path "c:\Users\ADMIN\OneDrive\Desktop\Abi\Abi\Wordpress\ChristmasLanding" -Recurse -File -Exclude "*.png", "*.jpg", "*.jpeg", "*.gif", "*.ico", "*.zip"

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $originalContent = $content

    # Replace package name and comments
    $content = $content -replace "package Santive", "package ChristmasLanding"
    $content = $content -replace "Santive", "ChristmasLanding"

    # Replace function prefixes and variables (snake_case)
    $content = $content -replace "santive_", "christmas_landing_"

    # Replace text domains and slugs (kebab-case)
    $content = $content -replace "'santive'", "'christmas-landing'"
    $content = $content -replace '"santive"', '"christmas-landing"'
    
    # Replace any remaining lowercase santive with christmas-landing (use with caution, maybe skip)
    # $content = $content -replace "santive", "christmas-landing" 

    if ($content -ne $originalContent) {
        Set-Content -Path $file.FullName -Value $content -NoNewline
        Write-Host "Updated $($file.Name)"
    }
}
