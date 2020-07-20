# Encryption API
An API that can be used for encryption and decryption of data using acceptable standards.<br />

1. AES-CTR + HMAC-SHA2 (<a href="https://csrc.nist.gov/projects/block-cipher-techniques" target="_blank">NIST</a>, <a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption" target="_blank">Paragon Initiative</a>)<br />
2. 10,000 iterations for password-based key derivation (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-132.pdf" target="_blank">NIST</a> - 1,000 minimum)<br />
3. Encrypt-then-MAC authentication (<a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption" target="_blank">Paragon Initiative</a>)<br />

### Example
Endpoint: encryption.php?action=encrypt<br />
Method: POST<br />
Body: {"data":"encrypted","authenticated":"yes","privacy":"yes","compliance":"yes"}<br />
Response: {"data":"enc-v1::Tkc4b2ZjRlhPZlJl::MzJkY2E0ZGY0MTAxZmNkMzgzYWNiMTNmZmJlYjJjNWI4OGZiMTRjMzM5YTAxZDdlY2NkNTFhOTlkMjBjNjg1Mg==::aUUDzASxjAqsZsaLpO5RWQ==::NgoigVuKdPrsxB+DZzp38g==","authenticated":"enc-v1::TEdpTQ==::MjJmNjdlMzI4N2Y4Y2ViZmU2YTViMmE4ZDZmNDJmYjYxYTEyZDcyYWQwMmZhZDBiZDllMWIzMTJhOGZlNjE2NQ==::vJxTzZsQj9t4nHzb97n1EQ==::VzguGzw1w4\/MAfTaFHDg+w==","privacy":"enc-v1::b05kbA==::YzY4ZmRiZGFjNDRmNzc0MmZjOGMxNjEzNmUzMzkxNTg0MzI0MGM2MzgzNjVlYzJlN2RkMGEzOWEyMWU2YzFkNg==::PHHhrpd0Wuxml\/8GNdmfnA==::s+XJtX3\/usw6dAImD7qSuw==","compliance":"enc-v1::SERicw==::OTQ0ZmJiYzM3ZWM0ODU4NzZiY2U2Zjk1YjQ1YWU4ZjIxOGYzN2VmMjE1MTFmM2M0MjU0NmQzNGYzYjQ5NWQ1YQ==::q5aPvA\/Ls\/ad04P+nbAQSw==::NQ5FNu+JcSF6+I3ahTlFfw=="}<br />
<br />
Endpoint: encryption.php?action=decrypt<br />
Method: POST<br />
Body: {"data":"enc-v1::Tkc4b2ZjRlhPZlJl::MzJkY2E0ZGY0MTAxZmNkMzgzYWNiMTNmZmJlYjJjNWI4OGZiMTRjMzM5YTAxZDdlY2NkNTFhOTlkMjBjNjg1Mg==::aUUDzASxjAqsZsaLpO5RWQ==::NgoigVuKdPrsxB+DZzp38g==","authenticated":"enc-v1::TEdpTQ==::MjJmNjdlMzI4N2Y4Y2ViZmU2YTViMmE4ZDZmNDJmYjYxYTEyZDcyYWQwMmZhZDBiZDllMWIzMTJhOGZlNjE2NQ==::vJxTzZsQj9t4nHzb97n1EQ==::VzguGzw1w4\/MAfTaFHDg+w==","privacy":"enc-v1::b05kbA==::YzY4ZmRiZGFjNDRmNzc0MmZjOGMxNjEzNmUzMzkxNTg0MzI0MGM2MzgzNjVlYzJlN2RkMGEzOWEyMWU2YzFkNg==::PHHhrpd0Wuxml\/8GNdmfnA==::s+XJtX3\/usw6dAImD7qSuw==","compliance":"enc-v1::SERicw==::OTQ0ZmJiYzM3ZWM0ODU4NzZiY2U2Zjk1YjQ1YWU4ZjIxOGYzN2VmMjE1MTFmM2M0MjU0NmQzNGYzYjQ5NWQ1YQ==::q5aPvA\/Ls\/ad04P+nbAQSw==::NQ5FNu+JcSF6+I3ahTlFfw=="}<br />
Response: {"data":"encrypted","authenticated":"yes","privacy":"yes","compliance":"yes"}

