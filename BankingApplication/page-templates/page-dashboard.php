<?php
/**
 * Template Name: Dashboard Page
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

$current_user = wp_get_current_user();
$balance = banking_get_balance($current_user->ID);
$transactions = get_user_meta($current_user->ID, 'banking_transactions', true);

if (!is_array($transactions)) {
    $transactions = array();
}

get_header(); ?>

<div class="container">
    <h2>Welcome, <?php echo esc_html($current_user->display_name); ?></h2>

    <div class="banking-card">
        <h3>Account Summary</h3>
        <div class="account-info">
            <div class="info-item">
                <span class="label">Account Number:</span>
                <span class="value">XXXX-XXXX-<?php echo rand(1000, 9999); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Account Type:</span>
                <span class="value">Savings Account</span>
            </div>
            <div class="info-item">
                <span class="label">Email:</span>
                <span class="value"><?php echo esc_html($current_user->user_email); ?></span>
            </div>
        </div>
    </div>

    <div class="banking-card">
        <h3>Current Balance</h3>
        <div class="balance-display">₹<span class="balance-amount"><?php echo esc_html($balance); ?></span></div>
        <div class="quick-actions">
            <a href="<?php echo home_url('/transfer'); ?>" class="btn">Transfer Money</a>
        </div>
    </div>

    <div class="banking-card">
        <h3>Recent Transactions</h3>
        <ul class="transaction-list">
            <?php if (empty($transactions)): ?>
                <li>No transactions found.</li>
            <?php else: ?>
                <?php foreach (array_slice($transactions, 0, 5) as $transaction): ?>
                    <li class="transaction-item <?php echo esc_attr($transaction['type']); ?>">
                        <div>
                            <strong><?php echo esc_html($transaction['type'] === 'credit' ? 'Received from ' . $transaction['from'] : 'Sent to ' . $transaction['to']); ?></strong><br>
                            <small><?php echo esc_html($transaction['date']); ?></small>
                            <?php if (!empty($transaction['remarks'])): ?>
                                <br><small><em><?php echo esc_html($transaction['remarks']); ?></em></small>
                            <?php endif; ?>
                        </div>
                        <div style="font-weight: bold;">
                            <?php echo $transaction['type'] === 'credit' ? '+' : '-'; ?>₹<?php echo number_format((float) $transaction['amount'], 2); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>

<?php get_footer(); ?>