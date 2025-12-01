<?php


if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

$current_user = wp_get_current_user();
$balance = banking_get_balance($current_user->ID);

get_header(); ?>

<div class="container transfer-container">
    <h2>Transfer Money</h2>

    <div class="banking-card">
        <h3>Send Money</h3>
        <p>Current Balance: <strong>$<?php echo esc_html($balance); ?></strong></p>

        <div id="transfer-message" class="alert"></div>

        <form id="banking-transfer-form">
            <div class="form-group">
                <label for="recipient_email">Recipient Email</label>
                <input type="email" id="recipient_email" name="recipient_email" required
                    placeholder="Enter recipient's email address">
            </div>
            <div class="form-group">
                <label for="amount">Amount ($)</label>
                <input type="number" id="amount" name="amount" min="1" step="0.01" required placeholder="0.00">
            </div>
            <button type="submit" class="btn">Transfer</button>
            <a href="<?php echo home_url('/dashboard'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php get_footer(); ?>