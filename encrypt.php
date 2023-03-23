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

encryptPdf('example.pdf', 'example-encrypted.pdf', 'my_password');


?>
