# Encryption API
An API that can be used for encryption and decryption of data using current standards.<br />

1. AES-256-CTR (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-38a.pdf" target="_blank">NIST SP-800-38A</a>, <a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption" target="_blank">Paragon Initiative</a>)<br />
2. HMAC-SHA-256 (<a href="https://csrc.nist.gov/csrc/media/publications/fips/198/1/final/documents/fips-198-1_final.pdf" target="_blank">FIPS-198-1</a>)
3. PBKDF2 (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-132.pdf" target="_blank">NIST SP-800-132</a>)
4. 10,000 iterations for password-based key derivation (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-132.pdf" target="_blank">NIST SP-800-132</a> - 1,000 minimum)<br />
5. HKDF (<a href="https://tools.ietf.org/html/rfc5869" target="_blank">RFC 5869</a> and <a href="https://nvlpubs.nist.gov/nistpubs/SpecialPublications/NIST.SP.800-56Cr1.pdf" target="_blank">NIST SP-800-56C Rev. 1</a>)
6. Encrypt-then-MAC authentication (<a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption#mac" target="_blank">Paragon Initiative</a>)<br />

### Example
#### Encryption
Endpoint: encryption.php?action=encrypt<br />
Method: POST<br />
Body: {"data":"encrypted","authenticated":"yes","privacy":"yes","compliance":"yes"}<br />
Response: {"data":"enc-v1::YXMrVVozeG00VTVP::ODE0NzY3YWNlNDdlZjMzOWQwZGVlNjA3ZTZkMGMzYTdiNWFhYTZjZGIxYTk5ZWQ1ZDJjOTQ5YzA0MjFmYmEzMQ==::74ulIhXxz3P+LLhMek0qkg==","authenticated":"enc-v1::VzNlaw==::MWVlNGY3OWVjYTIxNDMyMzg5N2FiYzBjOWRlMDNhOGI1MjZjOGJkMTYwMWI4OWNhMjVmOGNmNWJmZmJkM2Q3YQ==::Pbn4wu\/mtP4OAN8JP5ffVw==","privacy":"enc-v1::NjlPNA==::MWE1MzhlODFjMGRiYzJjNzk5ZjVmZDk0NGYzMDM3M2Y2NTg3ZTIzNDdiNDk3ZmVhNzdhZTA3OGYxNzUxZGU4NA==::cK\/JdQTgOqGUHLseVxPoyQ==","compliance":"enc-v1::RUJURA==::OTg4ZDc1MGY0MmZiNzE4ZjkzOTQyYzRiZGZmODI5NjQ2YzgzMzlmN2FhYzRmYzdiYWQ0OGEyOWNmYjIzMmM1NQ==::HS32b0rcZaCbVvtVN1PEjw=="}<br />
<br />
#### Decryption
Endpoint: encryption.php?action=decrypt<br />
Method: POST<br />
Body: {"data":"enc-v1::YXMrVVozeG00VTVP::ODE0NzY3YWNlNDdlZjMzOWQwZGVlNjA3ZTZkMGMzYTdiNWFhYTZjZGIxYTk5ZWQ1ZDJjOTQ5YzA0MjFmYmEzMQ==::74ulIhXxz3P+LLhMek0qkg==","authenticated":"enc-v1::VzNlaw==::MWVlNGY3OWVjYTIxNDMyMzg5N2FiYzBjOWRlMDNhOGI1MjZjOGJkMTYwMWI4OWNhMjVmOGNmNWJmZmJkM2Q3YQ==::Pbn4wu\/mtP4OAN8JP5ffVw==","privacy":"enc-v1::NjlPNA==::MWE1MzhlODFjMGRiYzJjNzk5ZjVmZDk0NGYzMDM3M2Y2NTg3ZTIzNDdiNDk3ZmVhNzdhZTA3OGYxNzUxZGU4NA==::cK\/JdQTgOqGUHLseVxPoyQ==","compliance":"enc-v1::RUJURA==::OTg4ZDc1MGY0MmZiNzE4ZjkzOTQyYzRiZGZmODI5NjQ2YzgzMzlmN2FhYzRmYzdiYWQ0OGEyOWNmYjIzMmM1NQ==::HS32b0rcZaCbVvtVN1PEjw=="}<br />
Response: {"data":"encrypted","authenticated":"yes","privacy":"yes","compliance":"yes"}

