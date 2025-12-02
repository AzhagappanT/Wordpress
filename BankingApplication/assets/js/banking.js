jQuery(document).ready(function ($) {

    // Tab Switching
    $('.tab-btn').click(function () {
        var tab = $(this).data('tab');

        $('.tab-btn').removeClass('active');
        $('.tab-content').removeClass('active');

        $(this).addClass('active');
        $('#transfer-' + tab + '-form').addClass('active');
    });

    // Login Form
    $('#banking-login-form').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var $message = $('#login-message');

        $submitBtn.prop('disabled', true).text('Logging in...');
        $message.hide().removeClass('alert-success alert-danger');

        $.ajax({
            url: banking_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'banking_login',
                username: $('#username').val(),
                password: $('#password').val(),
                nonce: banking_ajax.nonce
            },
            success: function (response) {
                if (response.success) {
                    $message.addClass('alert alert-success').text(response.data.message).show();
                    setTimeout(function () {
                        window.location.href = response.data.redirect;
                    }, 1000);
                } else {
                    $message.addClass('alert alert-danger').text(response.data.message).show();
                    $submitBtn.prop('disabled', false).text('Login');
                }
            },
            error: function () {
                $message.addClass('alert alert-danger').text('An error occurred. Please try again.').show();
                $submitBtn.prop('disabled', false).text('Login');
            }
        });
    });

    // Transfer Forms
    function setupTransferForm(formId) {
        $('#' + formId).on('submit', function (e) {
            e.preventDefault();

            var $form = $(this);
            var $submitBtn = $form.find('button[type="submit"]');
            var $message = $('#transfer-message');

            $submitBtn.prop('disabled', true).text('Processing...');
            $message.hide().removeClass('alert-success alert-danger');

            var formData = {
                action: 'banking_transfer',
                nonce: banking_ajax.nonce,
                amount: $form.find('input[name="amount"]').val(),
                remarks: $form.find('input[name="remarks"]').val()
            };

            // Add specific fields based on form
            if (formId === 'transfer-account-form') {
                formData.type = 'account';
                formData.account_number = $form.find('#account_number').val();
                formData.ifsc_code = $form.find('#ifsc_code').val();
                formData.account_holder = $form.find('#account_holder_name').val();
            } else {
                formData.type = 'mobile';
                formData.mobile_number = $form.find('#mobile_number').val();
            }

            $.ajax({
                url: banking_ajax.ajax_url,
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $message.addClass('alert alert-success').text(response.data.message).show();
                        $('#balance').text(response.data.new_balance);
                        $form[0].reset();
                    } else {
                        $message.addClass('alert alert-danger').text(response.data.message).show();
                    }
                    $submitBtn.prop('disabled', false).text('Transfer');
                },
                error: function () {
                    $message.addClass('alert alert-danger').text('An error occurred. Please try again.').show();
                    $submitBtn.prop('disabled', false).text('Transfer');
                }
            });
        });
    }

    setupTransferForm('transfer-account-form');
    setupTransferForm('transfer-mobile-form');

});
