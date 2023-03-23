<?php

// Encrypt PDF file with AES-256 encryption
function encryptPdf($sourceFile, $destFile, $password) {
    $cipher = 'AES-256-CBC';
    $key = substr(hash('sha256', $password, true), 0, 32);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
    $encryptedData = openssl_encrypt(file_get_contents($sourceFile), $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $encryptedData = $iv . $encryptedData;
    file_put_contents($destFile, $encryptedData);
}

function decryptPdf($sourceFile, $password) {
    $cipher = 'AES-256-CBC';
    $key = substr(hash('sha256', $password, true), 0, 32);
    $data = file_get_contents($sourceFile);
    $iv = substr($data, 0, openssl_cipher_iv_length($cipher));
    $encryptedData = substr($data, openssl_cipher_iv_length($cipher));
    $decryptedData = openssl_decrypt($encryptedData, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    return $decryptedData;
}

// Example usage: encrypt the file "example.pdf" and save it as "example-encrypted.pdf"

#encryptPdf('example.pdf', 'example-encrypted.pdf', 'my_password');

/*
$decryptedData = decryptPdf('example-encrypted.pdf', 'my_password');
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="example.pdf"');
echo $decryptedData;
*/
?>
