# M-Pesa Button Integration

This project demonstrates a simple web-based M-Pesa payment integration using HTML, CSS, JavaScript, PHP, and Safaricom Daraja API. The system allows users to:

- Click a button labeled **"Now Make Payment"**
- Enter an amount in Kenyan Shillings (KES)
- Initiate an STK Push request to their M-Pesa mobile number
- Complete the payment by entering their M-Pesa PIN on their phone

---

## 📂 Project Structure

Mpesa-Button/
│
├── index.html # Frontend UI with payment button and form
├── styles.css # Styling for the UI
├── stkpush.php # Backend logic to trigger STK Push via Safaricom API
├── callback.php # Endpoint to receive transaction status from Safaricom
├── README.md # Project description and setup

yaml
Copy
Edit

---

## 🔧 Requirements

- PHP >= 7.0
- XAMPP or any local server (e.g., Laravel Valet)
- Safaricom Daraja API credentials
- [Ngrok](https://ngrok.com/) (to expose your localhost for testing callbacks)

---

## 🚀 Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/AbsolomOndara/Mpesa-Button.git
   cd Mpesa-Button
Run Your Server

bash
Copy
Edit
php -S localhost:8000
Expose Localhost with Ngrok

bash
Copy
Edit
ngrok http 8000
Set the Callback URL in Safaricom Daraja Portal to the Ngrok URL:

arduino
Copy
Edit
https://your-ngrok-url.io/callback.php
📲 How It Works
When the user clicks "Now Make Payment", they are prompted to enter an amount.

The form sends the amount and phone number to stkpush.php.

The script sends a real-time STK Push to the user via Safaricom Daraja API.

The user enters their M-Pesa PIN to complete the transaction.

Safaricom calls your callback.php to confirm the transaction status.

🔐 Security Notes
Keep your consumer key and consumer secret safe.

Never expose your M-Pesa credentials in frontend files.

Ensure you use HTTPS (Ngrok or production server) for live payments.

