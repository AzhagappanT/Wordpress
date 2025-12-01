jQuery(document).ready(function($) {
    
    // Login Form Handler
    $('#banking-login-form').on('submit', function(e) {
        e.preventDefault();
        
        var username = $('#username').val();
        var password = $('#password').val();
        var $message = $('#login-message');
        
        $message.hide().removeClass('alert-success alert-danger');
        
        $.ajax({
            url: banking_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'banking_login',
                nonce: banking_ajax.nonce,
                username: username,
                password: password
            },
            success: function(response) {
                if (response.success) {
                    $message.addClass('alert alert-success').text(response.data.message).show();
                    setTimeout(function() {
                        window.location.href = response.data.redirect;
                    }, 1000);
                } else {
                    $message.addClass('alert alert-danger').text(response.data.message).show();
                }
            },
            error: function() {
                $message.addClass('alert alert-danger').text('An error occurred. Please try again.').show();
            }
        });
    });

    // Transfer Form Handler
    $('#banking-transfer-form').on('submit', function(e) {
        e.preventDefault();
        
        var recipient = $('#recipient_email').val();
        var amount = $('#amount').val();
        var $message = $('#transfer-message');
        var $submitBtn = $(this).find('button[type="submit"]');
        
        $message.hide().removeClass('alert-success alert-danger');
        $submitBtn.prop('disabled', true);
        
        $.ajax({
            url: banking_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'banking_transfer',
                nonce: banking_ajax.nonce,
                recipient_email: recipient,
                amount: amount
            },
            success: function(response) {
                if (response.success) {
                    $message.addClass('alert alert-success').text(response.data.message).show();
                    // Update balance display if it exists
                    $('.balance-amount').text(response.data.new_balance.toFixed(2));
                    // Reset form
                    $('#banking-transfer-form')[0].reset();
                } else {
                    $message.addClass('alert alert-danger').text(response.data.message).show();
                }
            },
            error: function() {
                $message.addClass('alert alert-danger').text('An error occurred. Please try again.').show();
            },
            complete: function() {
                $submitBtn.prop('disabled', false);
            }
        });
    });

});
