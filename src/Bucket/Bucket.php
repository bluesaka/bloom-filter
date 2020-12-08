<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Bucket;

abstract class Bucket
{
    /**
     * @var int int
     */
    protected int $total;

    public function __construct(int $total)
    {
        $this->total = $total;
    }

    protected function wrap($value)
    {
        return 'filter:' . $value;
    }

    abstract public function dispatch(string $key);
}
