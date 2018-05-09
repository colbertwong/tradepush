<?php

$postXml = file_get_contents('php://input');
$postUrl = 'http://59.46.194.58:8154/esales/esales.asmx?op=postesalescreate';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $postUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER,array("Content-Type: text/xml; charset=utf-8","Content-length: ".strlen($postXml)));
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postXml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tmpInfo = curl_exec($ch);
if (curl_errno($ch)) {
    header("HTTP/1.1 503 Service Unavailable");
    exit(1);
}
curl_close($ch);
header('Content-Type: text/xml; charset=utf-8');
echo $tmpInfo;
exit(0);
