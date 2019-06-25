<?php

namespace NEM\Crypto;

class KeyPair{
    public $privateKey;

    public $publicKey;

    public function __construct(){
        $privateKey = new PrivateKey();
        $publicKey = new PublicKey();
    }
    
	public function NewRandomKeyPair(){
        return NewKeyPairByEngine(CryptoEngines.DefaultEngine);
    }

    public function NewPubKeyPair(PrivateKey $privateKey){
        return NewKeyPair($privateKey, null, CryptoEngines.DefaultEngine);
    }
    
    //NewKeyPair The public key is calculated from the private key.
    //  The private key must by nil
    // if crypto engine is nil - default Engine
    public function NewKeyPair(PrivateKey $privateKey,PublicKey $publicKey,CryptoEngine $engine ){
    
        if ($engine == null) {
            $engine = CryptoEngines.DefaultEngine;
        }
    
        if ($publicKey == null) {
            $publicKey = $engine.CreateKeyGenerator().DerivePublicKey($privateKey);
        } 
        else if (!$engine.CreateKeyAnalyzer().IsKeyCompressed($publicKey)) {
            return "publicKey must be in compressed form";
        }
        $this->$publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    public function NewKeyPairByEngine(CryptoEngine $engine) {
        return $engine.CreateKeyGenerator().GenerateKeyPair();
    }
}
?>