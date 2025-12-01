<?php get_header(); ?>

<div class="hero">
    <h2>Welcome to <?php bloginfo('name'); ?></h2>
    <p>Secure, fast, and reliable banking for everyone.</p>

    <?php if (!is_user_logged_in()): ?>
        <a href="<?php echo home_url('/login'); ?>" class="btn">Login to your account</a>
    <?php else: ?>
        <a href="<?php echo home_url('/dashboard'); ?>" class="btn">Go to Dashboard</a>
    <?php endif; ?>
</div>

<?php get_footer(); ?>