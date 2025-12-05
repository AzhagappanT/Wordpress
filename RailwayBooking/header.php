<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="container">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
                <nav>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'fallback_cb' => false,
                    ));
                    ?>
                    <ul>
                        <?php if (is_user_logged_in()): ?>
                            <li><a href="<?php echo home_url('/my-bookings'); ?>">My Bookings</a></li>
                            <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo wp_login_url(); ?>">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="container">