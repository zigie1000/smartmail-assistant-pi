=== SmartMail Assistant ===
Contributors: Marco Zagato
Tags: email, AI, assistant, productivity
Requires at least: 5.0
Tested up to: 6.0
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

README for SmartMail Assistant Pi

SmartMail Assistant Pi

Description:
SmartMail Assistant Pi is an AI-powered email assistant integrated with the Pi Network for secure subscription management.

Features:

	•	Email Categorization
	•	Priority Inbox
	•	Auto Responses
	•	Email Summarization
	•	Meeting Scheduler
	•	Follow-Up Reminders
	•	Sentiment Analysis
	•	Email Templates

Installation:

	1.	Download the app.
	2.	Configure Pi Network settings in the app settings.
	3.	Register and authenticate with your Pi Network account.

Usage:

	•	Manage emails using AI-powered features.
	•	Use the integrated calendar for scheduling.
	•	Access sentiment analysis and categorization directly from the app.

Integration with Pi Network:

	•	Ensure you have a Pi Network account.
	•	Configure Pi SDK settings in config/pi-sdk-config.php:

module.exports = {
    apiKey: 'your-pi-network-api-key',
    apiSecret: 'your-pi-network-api-secret'
};


	•	Verify subscriptions through the centralized API on smartmail.store.

External Integration Capabilities:
SmartMail Assistant Pi offers a flexible API for developers, enabling integration with existing applications and extending functionalities to adapt to new requirements.

Support:
For support, visit SmartMail Support.

License:
This project is licensed under the PiOS License.

Contact:
For more information, visit SmartMail Store.

Integration in the PiOS System

Steps for Integration:

	1.	Register on PiOS: Register the SmartMail Assistant Pi project on the PiOS platform.
	2.	Configure Pi SDK: Ensure the Pi SDK is properly configured in config/pi-sdk-config.js:

module.exports = {
    apiKey: 'your-pi-network-api-key',
    apiSecret: 'your-pi-network-api-secret'
};


	3.	Subscription Verification: Implement centralized subscription verification using the smartmail.store API:

const checkSubscription = async (userId) => {
    const response = await fetch(`https://smartmail.store/api/check-subscription?user_id=${userId}`);
    const data = await response.json();
    return data.active;
};


	4.	Compliance with PiOS License: Ensure the app complies with the PiOS license by including the appropriate license text in the LICENSE file.