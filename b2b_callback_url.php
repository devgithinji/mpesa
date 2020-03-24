<?php

//Data
$callBackResponse = file_get_contents('php://input');

$logFile = "b2b_CallbackResponse.json";
$log = fopen($logFile, 'a');
fwrite($log, $callBackResponse);
fclose($log);
