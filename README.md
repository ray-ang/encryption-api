# Encryption API
An API that can be used for encryption and decryption of data using acceptable standards.<br />

1. AES-CTR + HMAC-SHA2 (<a href="https://csrc.nist.gov/projects/block-cipher-techniques" target="_blank">NIST</a>, <a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption" target="_blank">Paragon Initiative</a>)<br />
2. 10,000 iterations for password-based key derivation (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-132.pdf" target="_blank">NIST</a> - 1,000 minimum)<br />
3. Encrypt-then-MAC authentication (<a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption" target="_blank">Paragon Initiative</a>)<br />

### Example
Endpoint: encryption.php?action=encrypt<br />
Method: POST<br />
Body: 12345<br />
Response: enc-v1::RTNEUDJqRT0=::OWFkMGI4NDBlOTZhNjhiYThlZGJkMzI4OTRhNTU0ZmU1Nzk4ZDdlMTFiZjQxNzEzNDNmZmZkNDA4NjMzNmZkZg==::uet2Uhq/iUU+9ib5FDXMMQ==::c829lvY2cLEb3UdteczNCA==::v/cBUoWbSHjd2Lbzynqiog==<br />
<br />
Endpoint: encryption.php?action=decrypt<br />
Method: POST<br />
Body: enc-v1::RTNEUDJqRT0=::OWFkMGI4NDBlOTZhNjhiYThlZGJkMzI4OTRhNTU0ZmU1Nzk4ZDdlMTFiZjQxNzEzNDNmZmZkNDA4NjMzNmZkZg==::uet2Uhq/iUU+9ib5FDXMMQ==::c829lvY2cLEb3UdteczNCA==::v/cBUoWbSHjd2Lbzynqiog==<br />
Response: 12345

