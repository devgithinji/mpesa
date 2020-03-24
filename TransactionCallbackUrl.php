<?php

//Data
$callBackResponse = file_get_contents('php://input');

$logFile = "transaction_status.json";
$log = fopen($logFile, 'a');
fwrite($log, $callBackResponse);
fclose($log);