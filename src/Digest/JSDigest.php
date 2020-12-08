<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * Invented by Justin Sobel.
 */
class JSDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        $hash = 1315423911;

        if (!$length) {
            $length = strlen($key);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash ^= (($hash << 5) + ord($key[$i]) + ($hash >> 2));
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}
