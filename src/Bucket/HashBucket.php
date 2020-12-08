<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Bucket;

class HashBucket extends Bucket
{
    public function dispatch(string $key)
    {
        return $this->wrap(crc32($key) % $this->total);
    }
}
