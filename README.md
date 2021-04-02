# Encryption API
An API that can be used for encryption and decryption of data using BasicPHP class library and current cryptography standards.<br />

1. AES-256-GCM (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-38a.pdf" target="_blank">NIST SP-800-38A</a>, <a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption" target="_blank">Paragon Initiative</a>)<br />
2. HMAC-SHA-256 (<a href="https://csrc.nist.gov/csrc/media/publications/fips/198/1/final/documents/fips-198-1_final.pdf" target="_blank">FIPS-198-1</a>)
3. PBKDF2 (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-132.pdf" target="_blank">NIST SP-800-132</a>)
4. 10,000 iterations for password-based key derivation (<a href="https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-132.pdf" target="_blank">NIST SP-800-132</a> - 1,000 minimum)<br />
5. HKDF (<a href="https://tools.ietf.org/html/rfc5869" target="_blank">RFC 5869</a> and <a href="https://nvlpubs.nist.gov/nistpubs/SpecialPublications/NIST.SP.800-56Cr1.pdf" target="_blank">NIST SP-800-56C Rev. 1</a>)
6. Encrypt-then-MAC authentication (<a href="https://paragonie.com/white-paper/2015-secure-php-data-encryption#mac" target="_blank">Paragon Initiative</a>)<br />

### Example
#### Encryption
Endpoint: encryption.php?action=encrypt<br />
Method: POST<br />
Body:<br />
{"data":"encrypted","authenticated":"yes","privacy":"yes","compliance":"yes"}<br />
Response:<br />
{"data":"encv1.ek80R2pzN3NaRkxM.jFQGj3UxwqID8q9\/f8GfEQ.pp0nQpfJLuOYwTKlJwU20A","authenticated":"encv1.VWg3OQ.eFOXNO3bVL7NX1keIVTF0A.UBrI0BmU9F1FRyPhR1HJYA","privacy":"encv1.N0tLMg.GQB6ShSTe5dQlgUhRw33AQ.QWptKAm4I9Q2RYK1z5rS0w","compliance":"encv1.cjROaw.63xzrAxGDXruO6oqU32jtA.MnVAMl4DHiadP+GKdH2kyg"}<br />
<br />
#### Decryption
Endpoint: encryption.php?action=decrypt<br />
Method: POST<br />
Body:<br />
{"data":"encv1.ek80R2pzN3NaRkxM.jFQGj3UxwqID8q9\/f8GfEQ.pp0nQpfJLuOYwTKlJwU20A","authenticated":"encv1.VWg3OQ.eFOXNO3bVL7NX1keIVTF0A.UBrI0BmU9F1FRyPhR1HJYA","privacy":"encv1.N0tLMg.GQB6ShSTe5dQlgUhRw33AQ.QWptKAm4I9Q2RYK1z5rS0w","compliance":"encv1.cjROaw.63xzrAxGDXruO6oqU32jtA.MnVAMl4DHiadP+GKdH2kyg"}<br />
Response:<br />
{"data":"encrypted","authenticated":"yes","privacy":"yes","compliance":"yes"}

