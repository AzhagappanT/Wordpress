<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="container">
            <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            <nav>
                <ul>
                    <?php if (is_user_logged_in()): ?>
                        <li><a href="<?php echo home_url('/dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?php echo home_url('/transfer'); ?>">Transfer</a></li>
                        <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo home_url('/login'); ?>">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">