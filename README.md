# php_openssl_encrypt
PHP code to decrypt an encrypted PDF file and output it to the browser

For Example.pdf  encrypting  
```php
encryptPdf('example.pdf', 'example-encrypted.pdf', 'my_password');
```

Result output example-encrypted.pdf on Browser

```php
$decryptedData = decryptPdf('example-encrypted.pdf', 'my_password');
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="example.pdf"');
echo $decryptedData;
```
