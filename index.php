<?php
$url = 'https://testapi.multisafepay.com/ewx/';
$xmlFile = 'call-settings.xml';

//Get xml from file
$xml = file_get_contents($xmlFile);
//API call
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}else{
    //OBJ parser
    $xmlObj = simplexml_load_string($response);

    if ($xmlObj !== false) {
        $transactionID = $xmlObj->transaction->id;
        echo 'Transaction ID : ' . $transactionID;
    } else {
        echo 'Error on parse';
    }
}

curl_close($ch);
?>
