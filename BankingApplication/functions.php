<?php
/**
 * Banking Theme Functions
 */

function banking_enqueue_scripts() {
    wp_enqueue_style( 'banking-style', get_stylesheet_uri() );
    wp_enqueue_style( 'banking-custom-style', get_template_directory_uri() . '/assets/css/banking.css', array(), '1.0' );
    
    wp_enqueue_script( 'banking-script', get_template_directory_uri() . '/assets/js/banking.js', array('jquery'), '1.0', true );

    // Localize script for AJAX
    wp_localize_script( 'banking-script', 'banking_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'banking_nonce' )
    ));
}
add_action( 'wp_enqueue_scripts', 'banking_enqueue_scripts' );

// Handle Login
function banking_ajax_login() {
    check_ajax_referer( 'banking_nonce', 'nonce' );

    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );

    if ( is_wp_error( $user_signon ) ) {
        wp_send_json_error( array( 'message' => 'Invalid username or password.' ) );
    } else {
        wp_send_json_success( array( 'message' => 'Login successful!', 'redirect' => home_url('/dashboard') ) );
    }
}
add_action( 'wp_ajax_nopriv_banking_login', 'banking_ajax_login' );

// Handle Transfer
function banking_ajax_transfer() {
    check_ajax_referer( 'banking_nonce', 'nonce' );

    if ( ! is_user_logged_in() ) {
        wp_send_json_error( array( 'message' => 'You must be logged in.' ) );
    }

    $current_user_id = get_current_user_id();
    $recipient_email = sanitize_email( $_POST['recipient_email'] );
    $amount = floatval( $_POST['amount'] );

    if ( $amount <= 0 ) {
        wp_send_json_error( array( 'message' => 'Invalid amount.' ) );
    }

    $recipient = get_user_by( 'email', $recipient_email );

    if ( ! $recipient ) {
        wp_send_json_error( array( 'message' => 'Recipient not found.' ) );
    }

    if ( $recipient->ID === $current_user_id ) {
        wp_send_json_error( array( 'message' => 'You cannot transfer money to yourself.' ) );
    }

    // Get balances
    $sender_balance = (float) get_user_meta( $current_user_id, 'banking_balance', true );
    
    // Initialize balance if not set
    if ( '' === get_user_meta( $current_user_id, 'banking_balance', true ) ) {
        $sender_balance = 1000.00; // Sign up bonus / default for demo
        update_user_meta( $current_user_id, 'banking_balance', $sender_balance );
    }

    if ( $sender_balance < $amount ) {
        wp_send_json_error( array( 'message' => 'Insufficient funds.' ) );
    }

    $recipient_balance = (float) get_user_meta( $recipient->ID, 'banking_balance', true );
    
    // Update balances
    update_user_meta( $current_user_id, 'banking_balance', $sender_balance - $amount );
    update_user_meta( $recipient->ID, 'banking_balance', $recipient_balance + $amount );

    // Log transaction (Optional: could use a custom table or post type, using user meta for simplicity here)
    $transaction = array(
        'date' => current_time( 'mysql' ),
        'to' => $recipient->user_login,
        'amount' => $amount,
        'type' => 'debit'
    );
    add_user_meta( $current_user_id, 'banking_transactions', $transaction );

    $recipient_transaction = array(
        'date' => current_time( 'mysql' ),
        'from' => wp_get_current_user()->user_login,
        'amount' => $amount,
        'type' => 'credit'
    );
    add_user_meta( $recipient->ID, 'banking_transactions', $recipient_transaction );

    wp_send_json_success( array( 'message' => 'Transfer successful!', 'new_balance' => $sender_balance - $amount ) );
}
add_action( 'wp_ajax_banking_transfer', 'banking_ajax_transfer' );

// Helper to get balance
function banking_get_balance( $user_id ) {
    $balance = get_user_meta( $user_id, 'banking_balance', true );
    if ( '' === $balance ) {
        $balance = 1000.00; // Default demo balance
        update_user_meta( $user_id, 'banking_balance', $balance );
    }
    return number_format( (float)$balance, 2 );
}
