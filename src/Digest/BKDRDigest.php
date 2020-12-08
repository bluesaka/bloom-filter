<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * From "The C Programming Language" author: Brian Kernighan & Dennis Ritchie
 */
class BKDRDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        $hash = 0;
        $seed = 131;  // 31 131 1313 13131 131313 etc..

        if (!$length) {
            $length = strlen($key);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = ($hash * $seed) + ord($key[$i]);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }

}
