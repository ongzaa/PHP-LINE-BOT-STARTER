<?php
$access_token = 'Tw3Q8ZD5sM0v64J4d4EA3xIPhHuomz+dZu0fFIAkBqVfwmy/hmF7bx2EPmQGpRrPdzy1+Sjfpi8GLpXV2kIixMC0Pl4yIKq2tqGVSFLns90PL76EB2+PO0FDvN9CNECtu6exP6jOjy9PgiF92TmmngdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
