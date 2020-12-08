# bloom-filter
A bloom filter based on redis

# Install
```
composer require bluesaka/bloom-filter
```

# Usage
```
$redis = new Redis();
$redis->connect('127.0.0.1');

$digests = [
    new BKDRDigest(),
    new DEKDigest(),
    new DJBDigest(),
    new ELFDigest(),
    new FNVDigest(),
    new JSDigest(),
    new PJWDigest(),
    new SDBMDigest(),
    // ...
];

$filter = new BloomFilter($redis, new HashBucket(22), ...$digests);

$filter->add('testKey');

if ($filter->exists('testKey')) {
    //...
}
```