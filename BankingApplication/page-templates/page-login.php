<?php
/**
 * Template Name: Login Page
 */

if (is_user_logged_in()) {
    wp_redirect(home_url('/dashboard'));
    exit;
}

get_header(); ?>

<div class="container login-container">
    <div class="banking-card">
        <h3>Login to your Account</h3>
        <div id="login-message" class="alert"></div>
        <form id="banking-login-form">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</div>

<?php get_footer(); ?>