<?php
/*
Template Name: Landing Page
*/

get_header(); ?>

<div class="landing-page-container">
    <section class="hero">
        <h1>Welcome to SmartMail Assistant</h1>
        <p>Your AI-powered email assistant, now integrated with Pi Network for secure and seamless transactions.</p>
        <a href="https://smartmail.store" class="cta-button">Learn More</a>
    </section>

    <section class="features">
        <h2>Features</h2>
        <ul>
            <li>Email Categorization</li>
            <li>Priority Inbox</li>
            <li>Auto Responses</li>
            <li>Email Summarization</li>
            <li>Meeting Scheduler</li>
            <li>Follow-Up Reminders</li>
            <li>Sentiment Analysis</li>
            <li>Email Templates</li>
        </ul>
    </section>

    <section class="subscriptions">
        <h2>Subscriptions</h2>
        <p>We offer flexible subscription plans to suit your needs. All transactions are securely handled through the Pi Network.</p>
        <table>
            <tr>
                <th>Plan</th>
                <th>Price</th>
                <th>Features</th>
            </tr>
            <tr>
                <td>Free</td>
                <td>$0</td>
                <td>Email Categorization, Priority Inbox</td>
            </tr>
            <tr>
                <td>Trial</td>
                <td>$5/month</td>
                <td>All features for 30 days</td>
            </tr>
            <tr>
                <td>Subscribed</td>
                <td>$10/month</td>
                <td>All features</td>
            </tr>
        </table>
        <a href="https://smartmail.store/purchase" class="cta-button">Subscribe Now</a>
    </section>

    <section class="support">
        <h2>Need Help?</h2>
        <p>If you have any questions or need assistance, please visit our support page.</p>
        <a href="https://smartmail.store/support" class="cta-button">Get Support</a>
    </section>
</div>

<?php get_footer(); ?>