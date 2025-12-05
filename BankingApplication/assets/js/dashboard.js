jQuery(document).ready(function ($) {
    console.log("Dashboard Script Loaded");

    // Future implementation for Quick Transfer Form AJAX
    $('#quick-transfer-form').on('submit', function (e) {
        e.preventDefault();
        // AJAX handling will go here
    });

    // Add hover effects to cards
    $('.banking-card').hover(
        function () { $(this).addClass('hovered'); },
        function () { $(this).removeClass('hovered'); }
    );
});
