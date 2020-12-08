<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter;

use Bluesaka\BloomFilter\Bucket\Bucket;
use Bluesaka\BloomFilter\Digest\Digest;
use Redis;

class BloomFilter implements BloomFilterInterface
{
    /**
     * @var Bucket
     */
    protected Bucket $bucket;

    /**
     * @var Digest
     */
    protected $digests;

    /**
     * @var Redis
     */
    protected Redis $redis;

    public function __construct(Redis $redis, Bucket $bucket, Digest ...$digests)
    {
        $this->redis = $redis;
        $this->bucket = $bucket;
        $this->digests = $digests;
    }


    public function add(string $key)
    {
        $bucket = $this->bucket->dispatch($key);
        $pipe = $this->redis->multi();

        foreach ($this->digests as $digest) {
            /** @var Digest $digest */
            $pipe->setBit($bucket, $digest->hash($key), true);
        }

        return $pipe->exec();
    }

    public function exists(string $key)
    {
        $bucket = $this->bucket->dispatch($key);
        $pipe = $this->redis->multi();

        foreach ($this->digests as $digest) {
            /** @var Digest $digest */
            $pipe->getBit($bucket, $digest->hash($key));
        }

        $payloads = $pipe->exec();

        foreach ($payloads as $payload) {
            if (0 == $payload) {
                return false;
            }
        }

        return true;
    }
}