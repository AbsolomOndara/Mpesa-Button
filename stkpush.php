<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));
$amount = $data->amount;
$phoneNumber = "254724662792";

// Replace with your actual sandbox credentials
$consumerKey = 'YOUR_CONSUMER_KEY';
$consumerSecret = 'YOUR_CONSUMER_SECRET';
$BusinessShortCode = '174379'; // Sandbox paybill
$Passkey = 'YOUR_PASSKEY';

$Timestamp = date("YmdHis");
$password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

// 1. Generate Access Token
$authUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$credentials = base64_encode("$consumerKey:$consumerSecret");

$ch = curl_init($authUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic $credentials"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$access_token = json_decode($response)->access_token;
curl_close($ch);

// 2. STK Push
$stkUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackUrl = 'https://your-live-site.com/callback.php'; // Needs HTTPS

$stkData = [
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phoneNumber,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $phoneNumber,
    'CallBackURL' => $callbackUrl,
    'AccountReference' => 'OnlinePayment',
    'TransactionDesc' => 'Payment via Website'
];

$ch = curl_init($stkUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $access_token"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($stkData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo json_encode(["message" => "Payment prompt sent to your phone."]);
