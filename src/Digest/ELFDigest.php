<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * Like PjwDigest
 */
class ELFDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        $hash = 0;

        if (!$length) {
            $length = strlen($key);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = ($hash << 4) + ord($key[$i]);
            $x = $hash & 0xF0000000;

            if (0 != $x) {
                $hash ^= ($x >> 24);
            }

            $hash &= ~$x;
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}
