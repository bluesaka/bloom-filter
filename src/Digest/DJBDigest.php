<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * Invented by Daniel J. Bernstein
 */
class DJBDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        $hash = 5381;

        if (!$length) {
            $length = strlen($key);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = (int) (($hash << 5) + $hash) + ord($key[$i]);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}
