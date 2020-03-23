<?php


/*$consumerKey = 'Q7iPSZGcE22okEbWet9A91abFwGZtOpp'; //Replace with your app Consumer Key
$consumerSecret = 'EhkCgApwccdizVC1'; // Replace with your app Secret*/

$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
$credentials = base64_encode('Q7iPSZGcE22okEbWet9A91abFwGZtOpp:EhkCgApwccdizVC1');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$curl_response = curl_exec($curl);

echo json_decode($curl_response)->access_token;
