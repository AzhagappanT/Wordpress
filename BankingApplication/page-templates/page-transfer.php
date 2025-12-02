<?php
/**
 * Template Name: Transfer Page
 */

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
        <p>Available Balance: <strong>₹<span id="balance"><?php echo esc_html($balance); ?></span></strong></p>

        <div id="transfer-message" class="alert"></div>

        <div class="tabs">
            <button class="tab-btn active" data-tab="account">To Account</button>
            <button class="tab-btn" data-tab="mobile">To Mobile</button>
        </div>

        <!-- Transfer to Account -->
        <form id="transfer-account-form" class="tab-content active">
            <div class="form-group">
                <label for="account_number">Account Number</label>
                <input type="text" id="account_number" name="account_number" maxlength="16"
                    placeholder="Enter 16-digit account number" required>
            </div>
            <div class="form-group">
                <label for="ifsc_code">IFSC Code</label>
                <input type="text" id="ifsc_code" name="ifsc_code" maxlength="11" placeholder="e.g., ABANK0001234"
                    required>
            </div>
            <div class="form-group">
                <label for="account_holder_name">Account Holder Name</label>
                <input type="text" id="account_holder_name" name="account_holder_name"
                    placeholder="Enter beneficiary name" required>
            </div>
            <div class="form-group">
                <label for="account_amount">Amount (₹)</label>
                <input type="number" id="account_amount" name="amount" min="1" step="0.01" placeholder="0.00" required>
            </div>
            <div class="form-group">
                <label for="account_remarks">Remarks (Optional)</label>
                <input type="text" id="account_remarks" name="remarks" placeholder="e.g., Payment for services">
            </div>
            <button type="submit" class="btn">Transfer</button>
            <a href="<?php echo home_url('/dashboard'); ?>" class="btn btn-secondary">Cancel</a>
        </form>

        <!-- Transfer to Mobile -->
        <form id="transfer-mobile-form" class="tab-content">
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="tel" id="mobile_number" name="mobile_number" maxlength="10"
                    placeholder="Enter 10-digit mobile number" required>
            </div>
            <div class="form-group">
                <label for="mobile_amount">Amount (₹)</label>
                <input type="number" id="mobile_amount" name="amount" min="1" step="0.01" placeholder="0.00" required>
            </div>
            <div class="form-group">
                <label for="mobile_remarks">Remarks (Optional)</label>
                <input type="text" id="mobile_remarks" name="remarks" placeholder="e.g., Reimbursement">
            </div>
            <button type="submit" class="btn">Transfer</button>
            <a href="<?php echo home_url('/dashboard'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php get_footer(); ?>