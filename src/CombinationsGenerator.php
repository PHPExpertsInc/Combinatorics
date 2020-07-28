<?php declare(strict_types=1);

/**
 * This file is part of Combinatorics, a PHP Experts, Inc., Project.
 *
 * Copyright © 2019 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/Combinatorics
 *
 * This file is licensed under the MIT License.
 */

namespace PHPExperts\Combinatorics;

class CombinationsGenerator
{
    /**
     * Taken from https://stackoverflow.com/a/56598845/430062.
     *
     * @param array $list
     *
     * @return \Generator
     */
    public function generate(array $list): \Generator
    {
        // Generate even partial combinations.
        $list = array_values($list);
        $listCount = count($list);
        for ($a = 0; $a < $listCount; ++$a) {
            yield [$list[$a]];
        }

        if ($listCount > 2) {
            for ($i = 0; $i < count($list); ++$i) {
                $listCopy = $list;

                $entry = array_splice($listCopy, $i, 1);
                foreach ($this->generate($listCopy) as $combination) {
                    yield array_merge($entry, $combination);
                }
            }
        } elseif (count($list) > 0) {
            yield $list;

            if (count($list) > 1) {
                yield array_reverse($list);
            }
        }
    }
}
