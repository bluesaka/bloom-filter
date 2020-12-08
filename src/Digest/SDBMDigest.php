<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * From SDBM project
 */
class SDBMDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        $hash = 0;

        if (!$length) {
            $length = strlen($key);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = (int) (ord($key[$i]) + ($hash << 6) + ($hash << 16) - $hash);
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}