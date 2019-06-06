<?php
class Hash
{
    /**
     * @param string $algo The algorithm (md5, sha256, whirlpool, etc)
     * @param string $data The data to encode
     * @param string $salt The salt (This should be the same throughout the system, probably)
     * @param string string the hashed/salted data
     * 
     */
    public static function create($algo,$data, $salt){//making it possible to pass the algorithm we want, as well the data to encrypt, and a custom salt key
        $context = hash_init($algo,HASH_HMAC,$salt);
        hash_update($context,$data);

        return hash_final($context);
    }
}

?>