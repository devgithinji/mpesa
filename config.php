<?php

function insert_response($jsonMpesaResponse)
{
    try {
        $con = new PDO("mysql:dbhost=localhost;dbname=payments", 'root', '');
        echo "connection was successful";
    } catch (PDOException $exception) {
        die("error: connecting " . $exception->getMessage());
    }

    try {
        $insert = $con->prepare("INSERT INTO `mobilepayments`( `Transactiontype`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`,
 `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`)
 VALUES(:TransactionType,:TransID,:TransTime,:TransAmount,:BusinessShortCode,:BillRefNumber,:InvoiceNumber,:OrgAccountBalance,:ThirdPartyTransID,:MSISDN, :FirstName,:MiddleName,:LastName)");

        $insert->execute((array)($jsonMpesaResponse));

        $Transaction = fopen('Transaction.txt', 'a');
        fwrite($Transaction, json_encode($jsonMpesaResponse));
        fclose($Transaction);

    } catch (PDOException $exception) {
        $errlog = fopen("error.txt", 'a');
        fwrite($errlog, $exception->getMessage());
        fclose($errlog);

        $logFailedTransaction = fopen('failedTransaction.txt', 'a');
        fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
        fclose($logFailedTransaction);

    }
}