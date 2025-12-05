<?php
/**
 * WordPress Index - Minimal Setup for Banking Application Demo
 */

// Simple router for development
$request_uri = $_SERVER['REQUEST_URI'];
$php_self = $_SERVER['PHP_SELF'];

// Serve static files
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $request_uri)) {
    return false;
}

// For now, redirect to demo version
header('Location: ../demo/index.html');
exit;
