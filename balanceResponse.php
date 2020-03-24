<?php

//Data
$BalanceResponse = file_get_contents('php://input');

$logFile = "BalanceResponse.json";
$log = fopen($logFile, 'a');
fwrite($log, $BalanceResponse);
fclose($log);
