<?php
/**
 * Banking Theme Functions
 */

function banking_enqueue_scripts()
{
    wp_enqueue_style('banking-style', get_stylesheet_uri());
    wp_enqueue_style('banking-custom-style', get_template_directory_uri() . '/assets/css/banking.css', array(), '1.0');

    wp_enqueue_script('banking-script', get_template_directory_uri() . '/assets/js/banking.js', array('jquery'), '1.0', true);

    // Localize script for AJAX
    wp_localize_script('banking-script', 'banking_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('banking_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'banking_enqueue_scripts');

// Handle Login
function banking_ajax_login()
{
    check_ajax_referer('banking_nonce', 'nonce');

    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);

    if (is_wp_error($user_signon)) {
        wp_send_json_error(array('message' => 'Invalid username or password.'));
    } else {
        wp_send_json_success(array('message' => 'Login successful!', 'redirect' => home_url('/dashboard')));
    }
}
add_action('wp_ajax_nopriv_banking_login', 'banking_ajax_login');

// Handle Transfer
function banking_ajax_transfer()
{
    check_ajax_referer('banking_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'You must be logged in.'));
    }

    $current_user_id = get_current_user_id();
    $amount = floatval($_POST['amount']);
    $type = sanitize_text_field($_POST['type']);
    $remarks = sanitize_text_field($_POST['remarks']);

    if ($amount <= 0) {
        wp_send_json_error(array('message' => 'Invalid amount.'));
    }

    // Get sender balance
    $sender_balance = (float) get_user_meta($current_user_id, 'banking_balance', true);

    // Initialize balance if not set
    if ('' === get_user_meta($current_user_id, 'banking_balance', true)) {
        $sender_balance = 100000.00; // Default demo balance 1 Lakh
        update_user_meta($current_user_id, 'banking_balance', $sender_balance);
    }

    if ($sender_balance < $amount) {
        wp_send_json_error(array('message' => 'Insufficient funds.'));
    }

    // Simulate Recipient Lookup
    // In a real app, we would query users by meta key (account_number or mobile)
    // For this demo, we will simulate success to ensure HR can test it easily

    $recipient_name = "Beneficiary";
    $recipient_details = "";

    if ($type === 'account') {
        $account_number = sanitize_text_field($_POST['account_number']);
        $ifsc = sanitize_text_field($_POST['ifsc_code']);
        $holder = sanitize_text_field($_POST['account_holder']);
        $recipient_details = "Account: $account_number ($holder)";
        $recipient_name = $holder;
    } else {
        $mobile = sanitize_text_field($_POST['mobile_number']);
        $recipient_details = "Mobile: $mobile";
        $recipient_name = "Mobile User";
    }

    // Update sender balance
    $new_balance = $sender_balance - $amount;
    update_user_meta($current_user_id, 'banking_balance', $new_balance);

    // Log transaction
    $transaction = array(
        'date' => current_time('mysql'),
        'to' => $recipient_name,
        'details' => $recipient_details,
        'amount' => $amount,
        'type' => 'debit',
        'remarks' => $remarks
    );

    // Get existing transactions
    $transactions = get_user_meta($current_user_id, 'banking_transactions', true);
    if (!is_array($transactions)) {
        $transactions = array();
    }

    // Prepend new transaction
    array_unshift($transactions, $transaction);

    // Limit to last 50 transactions
    $transactions = array_slice($transactions, 0, 50);

    update_user_meta($current_user_id, 'banking_transactions', $transactions);

    wp_send_json_success(array(
        'message' => 'Transfer successful! ₹' . number_format($amount, 2) . ' sent.',
        'new_balance' => number_format($new_balance, 2)
    ));
}
add_action('wp_ajax_banking_transfer', 'banking_ajax_transfer');

// Helper to get balance
function banking_get_balance($user_id)
{
    $balance = get_user_meta($user_id, 'banking_balance', true);
    if ('' === $balance) {
        $balance = 100000.00; // Default demo balance
        update_user_meta($user_id, 'banking_balance', $balance);
    }
    return number_format((float) $balance, 2);
}
