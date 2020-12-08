<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter;

interface BloomFilterInterface
{
    public function add(string $key);

    public function exists(string $key);
}
