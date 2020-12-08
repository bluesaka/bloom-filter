<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * Invented by Donald E. Knuth
 */
class DEKDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        if (!$length) {
            $length = strlen($key);
        }

        $hash = $length;

        for ($i = 0; $i < $length; ++$i) {
            $hash = (($hash << 5) ^ ($hash >> 27)) ^ ord($key[$i]);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }

}
