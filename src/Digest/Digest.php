<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

interface Digest
{
    public function hash(string $key, int $length = 0);
}
