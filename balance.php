<?php
//urls
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$balance_url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';


//variables
$consumerKey = 'Q7iPSZGcE22okEbWet9A91abFwGZtOpp'; //Replace with your app Consumer Key
$consumerSecret = 'EhkCgApwccdizVC1'; // Replace with your app Secret

/*$Initiator = 'testapi';
$SecurityCredential = 'OcfyXOgyaSUbqRu3TJ7YyxCPeL3Uxp9VgJosYzRcZcOKl961uKukPxdByf9N+jicoPfK0PlDVm7nrafmdN5DHrLmuwr3vK9/mqAWAwL8WOit84pjEaQhGjI7M81t25Ie66eWWhv5vMyRXfnJoEX9/JLff4QNwTuiqxVPYf/gXUf1NgB8FQwiEX8k1xJXF+LlfTMWbP9wOoT+hjF8jW0IWl5ZPDQ6NWp7uCZmOt5EC+W6ea55alCynZ1h7tKyCp6JD2IIRDxV9HiVkbRN6UWgvjnWkQBxEkEj24xQKTOs2RINtFIslKqPs2QnJ8E0AY5RvhqY/XNEU/syNEwmTW4byQ==';
$PartyA = '600196';
$IdentifierType = '4';
$Remarks = 'Balance';
$URL = 'http://31.220.59.152/test/balanceResponse.php';*/


//access token
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
curl_setopt($curl, CURLOPT_URL, $balance_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); //setting custom header


$curl_post_data = array(
    //Fill in the request parameters with valid values
    'Initiator' => 'testapi',
    'SecurityCredential' => 'OcfyXOgyaSUbqRu3TJ7YyxCPeL3Uxp9VgJosYzRcZcOKl961uKukPxdByf9N+jicoPfK0PlDVm7nrafmdN5DHrLmuwr3vK9/mqAWAwL8WOit84pjEaQhGjI7M81t25Ie66eWWhv5vMyRXfnJoEX9/JLff4QNwTuiqxVPYf/gXUf1NgB8FQwiEX8k1xJXF+LlfTMWbP9wOoT+hjF8jW0IWl5ZPDQ6NWp7uCZmOt5EC+W6ea55alCynZ1h7tKyCp6JD2IIRDxV9HiVkbRN6UWgvjnWkQBxEkEj24xQKTOs2RINtFIslKqPs2QnJ8E0AY5RvhqY/XNEU/syNEwmTW4byQ==',
    'CommandID' => 'AccountBalance',
    'PartyA' => '600196',
    'IdentifierType' => '4',
    'Remarks' => 'Balance',
    'QueueTimeOutURL' => 'http://31.220.59.152/test/balanceResponse.php',
    'ResultURL' => 'http://31.220.59.152/test/balanceResponse.php'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
