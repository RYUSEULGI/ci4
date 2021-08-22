<?php

class Crypt
{

    private $cipher, $key, $ivlen, $iv;

    function __construct()
    {
        $this->cipher = "AES-256-CBC";
        // $this->key = openssl_random_pseudo_bytes(32);
        $this->key = "fsfdsflskdflskdcnsjdscscdsd";
        $this->iv = "wrelwjreiod%$3klr2j";
        $this->ivlen = 45;
        // $this->ivlen = openssl_cipher_iv_length($this->cipher);
        // $this->iv = openssl_random_pseudo_bytes($this->ivlen);
    }

    function encrypt($data)
    {
        if (in_array($this->cipher, openssl_get_cipher_methods())) {
            return openssl_encrypt($data, $this->cipher, $this->key, 0, $this->iv);
        } else {
            return new Exception("encrypt error");
        }
    }

    function decrypt($data)
    {
        if (in_array($this->cipher, openssl_get_cipher_methods())) {
            return openssl_decrypt($data, $this->cipher, $this->key, 0, $this->iv);
        } else {
            return new Exception("decrypt error");
        }
    }
}
