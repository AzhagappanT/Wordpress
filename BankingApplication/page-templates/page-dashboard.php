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
$transactions = get_user_meta($current_user->ID, 'banking_transactions', false); // false returns array of all values

get_header(); ?>

<div class="container">
    <h2>Welcome, <?php echo esc_html($current_user->display_name); ?></h2>

    <div class="banking-card">
        <h3>Current Balance</h3>
        <div class="balance-display">$<span class="balance-amount"><?php echo esc_html($balance); ?></span></div>
        <div style="text-align: center;">
            <a href="<?php echo home_url('/transfer'); ?>" class="btn">Transfer Money</a>
        </div>
    </div>

    <div class="banking-card">
        <h3>Recent Transactions</h3>
        <?php if (empty($transactions)): ?>
            <p>No transactions found.</p>
        <?php else: ?>
            <ul class="transaction-list">
                <?php
                // Show last 5 transactions, reversed
                $transactions = array_reverse($transactions);
                $transactions = array_slice($transactions, 0, 5);

                foreach ($transactions as $t):
                    $class = ($t['type'] === 'credit') ? 'credit' : 'debit';
                    $sign = ($t['type'] === 'credit') ? '+' : '-';
                    ?>
                    <li class="transaction-item <?php echo $class; ?>">
                        <div>
                            <strong><?php echo ($t['type'] === 'credit') ? 'Received from ' . esc_html($t['from']) : 'Sent to ' . esc_html($t['to']); ?></strong>
                            <br>
                            <small><?php echo date('M j, Y g:i a', strtotime($t['date'])); ?></small>
                        </div>
                        <div style="font-weight: bold;">
                            <?php echo $sign; ?>$<?php echo number_format($t['amount'], 2); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>