<?php
function decryptPdf($sourceFile, $password) {
    $cipher = 'AES-256-CBC';
    $key = substr(hash('sha256', $password, true), 0, 32);
    $data = file_get_contents($sourceFile);
    $iv = substr($data, 0, openssl_cipher_iv_length($cipher));
    $encryptedData = substr($data, openssl_cipher_iv_length($cipher));
    $decryptedData = openssl_decrypt($encryptedData, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    return $decryptedData;
}

$decryptedData = decryptPdf('example-encrypted.pdf', 'my_password');
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="example.pdf"');
echo $decryptedData;

?>
