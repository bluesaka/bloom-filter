<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * @see http://www.isthe.com/chongo/tech/comp/fnv/
 */
class FNVDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        $prime = 16777619; // prime 2^24 + 2^8 + 0x93 = 16777619
        $hash = 2166136261; // offset

        if (!$length) {
            $length = strlen($key);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = (int) ($hash * $prime) % 0xFFFFFFFF;
            $hash ^= ord($key[$i]);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}
