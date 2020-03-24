<?php

//Data
$callBackResponse = file_get_contents('php://input');

$logFile = "CallbackResponse.txt";
$log = fopen($logFile, 'a');
fwrite($log, $callBackResponse);
fclose($log);
