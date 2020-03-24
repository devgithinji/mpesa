<?php
//urls
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

//variables
$consumerKey = 'Q7iPSZGcE22okEbWet9A91abFwGZtOpp'; //Replace with your app Consumer Key
$consumerSecret = 'EhkCgApwccdizVC1'; // Replace with your app Secret

$InitiatorName = 'testapi';
$SecurityCredential = 'dZrQMrV5CROxCdgA009cxT92EO6M9oBB7Rg5QNuion2iXuh1L72SRpS0ulvAgT2bIT75fQdtu/kjvqFF/xVyvTQ2JkpxsusER0oBx5g0WYlukVUGXDAmYdSQKBR7qDbxtPlGA3p9QsduJ7JF6zjJA+tEo7JWqYbF1bXvFAH7a2GYrMaspejYC2AewpuwuwQv3AFHpkEroVRFVpG3kVsQWGjZ6zoVMMJMFt/u3bWL70pLMEVm34mJZo/froFKUL7t7NOUdyV+E8iI+FxVjsxP1WJ5zBd+ROs8LGt6PNENKyNQ3d0EqK91CDpHTB3J3YFCO5loNQWqQ1fjcVGI7rmuKg==';
$CommandID = 'SalaryPayment';
$Amount = '2500';
$PartyA = '600196';
$PartyB = '254708374149';
$Remarks = 'Salary';
$QueueTimeOutURL = 'http://31.220.59.152/test/callback_url.php';
$ResultURL = 'http://31.220.59.152/test/callback_url.php';
$Occasion = 'salary November 2018';

//Access token

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $access_token_url);
$credentials = base64_encode($consumerKey . ':' . $consumerSecret);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$curl_response = curl_exec($curl);


$access_token = json_decode($curl_response)->access_token;

//main request

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $b2c_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); //setting custom header


$curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => $InitiatorName,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL,
    'Occasion' => $Occasion
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;