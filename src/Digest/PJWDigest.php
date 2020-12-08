<?php declare(strict_types=1);

namespace Bluesaka\BloomFilter\Digest;

/**
 * Invented by Peter J. Weinberger of AT＆T
 */
class PJWDigest implements Digest
{
    public function hash(string $key, int $length = 0)
    {
        $bitsInUnsignedInt = 4 * 8; //（unsigned int）（sizeof（unsigned int）* 8）;
        $threeQuarters = ($bitsInUnsignedInt * 3) / 4;
        $oneEighth = $bitsInUnsignedInt / 8;
        $highBits = 0xFFFFFFFF << (int) ($bitsInUnsignedInt - $oneEighth);
        $hash = 0;

        if (!$length) {
            $length = strlen($key);
        }

        for ($i = 0; $i < $length; ++$i) {
            $hash = ($hash << (int) ($oneEighth)) + ord($key[$i]);
        }

        $test = $hash & $highBits;

        if (0 != $test) {
            $hash = (($hash ^ ($test >> (int) ($threeQuarters))) & (~$highBits));
        }

        return ($hash % 0xFFFFFFFF) & 0xFFFFFFFF;
    }
}