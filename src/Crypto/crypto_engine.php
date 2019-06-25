<?php

namespace NEM\Crypto;

// CryptoEngine represents a cryptographic engine that is a factory of crypto-providers.
interface CryptoEngine{
    // Creates a DSA signer.
    public function CreateDsaSigner(KeyPair $keyPair);
    // Creates a key generator.
    public function CreateKeyGenerator();
    //Creates a block cipher.
    public function CreateBlockCipher(KeyPair $senderKeyPair ,KeyPair $recipientKeyPair); 
    // Creates a key analyzer.
    public function CreateKeyAnalyzer();
}
?>