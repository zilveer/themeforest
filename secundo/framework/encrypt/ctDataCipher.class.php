<?php

/**
 * Encrypts/decrytps data
 */
class ctDataCipher
{
    const KEY_SLUG = 'ct_cipher_key';
    /**
     * @var ctAes
     */

    protected $crypter;

    protected $key;

    /**
     * ctDataCipher constructor.
     */

    public function __construct()
    {
        $this->crypter = new AesCtr();

        if (!get_option(self::KEY_SLUG)) {
            update_option(self::KEY_SLUG, md5(rand(1000, 100000) . time()));
        }

        $this->key = get_option(self::KEY_SLUG);
    }

    public function encrypt($data)
    {
        return $this->crypter->encrypt($data, $this->key, 128);
    }

    public function decrypt($data)
    {
        return $this->crypter->decrypt($data, $this->key, 128);
    }

}