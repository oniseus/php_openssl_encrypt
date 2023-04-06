<?php
$file_url = 'https://example.ge/image.png';
$decryption_key = 'your_key_here';
$cert_path = '/path/to/your/cert.pem';

// Create a new cURL resource
$ch = curl_init();

// Set the URL and other options
curl_setopt($ch, CURLOPT_URL, $file_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_CAINFO, $cert_path);

// Get the file content and decryption key
$file_content = curl_exec($ch);

// Close cURL resource
curl_close($ch);

// Decrypt the file content using the key
$decrypted_content = openssl_decrypt($file_content, 'aes-256-cbc', $decryption_key, OPENSSL_RAW_DATA);

// Set the appropriate header for PNG file
header('Content-Type: image/png');

// Send the decrypted content to the client
echo $decrypted_content;
?>
