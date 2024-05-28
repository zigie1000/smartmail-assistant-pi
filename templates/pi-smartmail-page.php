<?php
/*
Template Name: Pi SmartMail Page
*/

get_header(); ?>

<div class="pi-smartmail-container">
    <h1>SmartMail Assistant Pi</h1>
    <p>Welcome to the SmartMail Assistant Pi page. Here you can access all the features provided by the Pi integration.</p>

    <!-- Pi Payment Integration -->
    <div id="pi-payment">
        <h2>Pi Payment</h2>
        <form id="pi-payment-form" method="post" action="">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required>
            <input type="submit" value="Pay with Pi">
        </form>
        <div id="payment-status"></div>
    </div>
</div>

<script>
document.getElementById('pi-payment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var amount = document.getElementById('amount').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/wp-admin/admin-ajax.php?action=pi_payment', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('payment-status').innerHTML = xhr.responseText;
    };
    xhr.send('amount=' + amount);
});
</script>

<?php get_footer(); ?>
