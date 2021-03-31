<?php declare(strict_types=1);

/**
 * This file is part of Combinatorics, a PHP Experts, Inc., Project.
 *
 * Copyright © 2019-2021 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/Combinatorics
 *
 * This file is licensed under the MIT License.
 */

namespace PHPExperts\Combinatorics\Tests;

use PHPExperts\Combinatorics\CombinationsGenerator;

class CombinationGeneratorTest extends TestCase
{
    protected static function dumpCombos(array $array): void
    {
        echo "[\n";
        foreach ($array as $i => $combo) {
            echo "    $i => [ '" . implode(', ', $combo) . "' ], \n";
        }
        echo "]\n";
    }

    public function testCanGenerateAllPossibleCombinations()
    {
        $styles = [
            'bold',
            'italics',
            'underline',
            'dim',
        ];

        $allPossibleCombinations = [
            ['bold'],
            ['bold', 'italics'],
            ['bold', 'underline'],
            ['bold', 'dim'],
            ['bold', 'italics', 'underline'],
            ['bold', 'italics', 'dim'],
            ['bold', 'underline', 'italics'],
            ['bold', 'underline', 'dim'],
            ['bold', 'dim', 'italics'],
            ['bold', 'dim', 'underline'],
            ['bold', 'italics', 'underline', 'dim'],
            ['bold', 'italics', 'dim', 'underline'],
            ['bold', 'underline', 'italics', 'dim'],
            ['bold', 'underline', 'dim', 'italics'],
            ['bold', 'dim', 'italics', 'underline'],
            ['bold', 'dim', 'underline', 'italics'],
            ['italics', 'bold'],
            ['italics', 'bold', 'underline'],
            ['italics', 'bold', 'dim'],
            ['italics', 'bold', 'underline', 'dim'],
            ['italics', 'bold', 'dim', 'underline'],
            ['italics'],
            ['italics', 'underline'],
            ['italics', 'dim'],
            ['italics', 'underline', 'bold'],
            ['italics', 'underline', 'dim'],
            ['italics', 'dim', 'bold'],
            ['italics', 'dim', 'underline'],
            ['italics', 'underline', 'bold', 'dim'],
            ['italics', 'underline', 'dim', 'bold'],
            ['italics', 'dim', 'bold', 'underline'],
            ['italics', 'dim', 'underline', 'bold'],
            ['underline', 'bold'],
            ['underline', 'bold', 'italics'],
            ['underline', 'bold', 'dim'],
            ['underline', 'bold', 'italics', 'dim'],
            ['underline', 'bold', 'dim', 'italics'],
            ['underline', 'italics', 'bold'],
            ['underline', 'italics', 'bold', 'dim'],
            ['underline', 'italics'],
            ['underline', 'italics', 'dim'],
            ['underline', 'italics', 'dim', 'bold'],
            ['underline'],
            ['underline', 'dim'],
            ['underline', 'dim', 'bold'],
            ['underline', 'dim', 'italics'],
            ['underline', 'dim', 'bold', 'italics'],
            ['underline', 'dim', 'italics', 'bold'],
            ['dim', 'bold'],
            ['dim', 'bold', 'italics'],
            ['dim', 'bold', 'underline'],
            ['dim', 'bold', 'italics', 'underline'],
            ['dim', 'bold', 'underline', 'italics'],
            ['dim', 'italics', 'bold'],
            ['dim', 'italics', 'bold', 'underline'],
            ['dim', 'italics'],
            ['dim', 'italics', 'underline'],
            ['dim', 'italics', 'underline', 'bold'],
            ['dim', 'underline', 'bold'],
            ['dim', 'underline', 'bold', 'italics'],
            ['dim', 'underline', 'italics', 'bold'],
            ['dim', 'underline', 'italics'],
            ['dim', 'underline'],
            ['dim'],
        ];

        $generatedCombinations = [];
        $generator = new CombinationsGenerator();

        foreach ($generator->generate($styles) as $combination) {
            $generatedCombinations[] = $combination;
        }

        if (self::isDebugOn()) {
            dump($generatedCombinations);
        }

        // Search all possibilities for impossible combinations.
        foreach ($generatedCombinations as $combo) {
            if (!in_array($combo, $allPossibleCombinations)) {
                dump($allPossibleCombinations);
                self::fail('Found an impossible combination: ' . implode(',', $combo));
            }

            $position = array_search($combo, $allPossibleCombinations);

            if (self::isDebugOn()) {
                dump('Unsetting ' . implode(',', $combo) . " @ $position");
            }
            unset($allPossibleCombinations[$position]);
        }

        self::assertEmpty($allPossibleCombinations, 'Not all of the possible combinations were generated.');
    }

    public function testFitnessTestTo5Levels()
    {
        $items = array_slice(range('A', 'Z'), 0, 5);

        $allPossibilities = [
            0   => 'A',
            1   => 'B',
            2   => 'C',
            3   => 'D',
            4   => 'E',
            5   => 'A, B',
            6   => 'A, C',
            7   => 'A, D',
            8   => 'A, E',
            9   => 'B, A',
            10  => 'B, C',
            11  => 'B, D',
            12  => 'B, E',
            13  => 'C, A',
            14  => 'C, B',
            15  => 'C, D',
            16  => 'C, E',
            17  => 'D, A',
            18  => 'D, B',
            19  => 'D, C',
            20  => 'D, E',
            21  => 'E, A',
            22  => 'E, B',
            23  => 'E, C',
            24  => 'E, D',
            25  => 'A, B, C',
            26  => 'A, B, D',
            27  => 'A, B, E',
            28  => 'A, C, B',
            29  => 'A, C, D',
            30  => 'A, C, E',
            31  => 'A, D, B',
            32  => 'A, D, C',
            33  => 'A, D, E',
            34  => 'A, E, B',
            35  => 'A, E, C',
            36  => 'A, E, D',
            37  => 'B, A, C',
            38  => 'B, A, D',
            39  => 'B, A, E',
            40  => 'B, C, A',
            41  => 'B, C, D',
            42  => 'B, C, E',
            43  => 'B, D, A',
            44  => 'B, D, C',
            45  => 'B, D, E',
            46  => 'B, E, A',
            47  => 'B, E, C',
            48  => 'B, E, D',
            49  => 'C, A, B',
            50  => 'C, A, D',
            51  => 'C, A, E',
            52  => 'C, B, A',
            53  => 'C, B, D',
            54  => 'C, B, E',
            55  => 'C, D, A',
            56  => 'C, D, B',
            57  => 'C, D, E',
            58  => 'C, E, A',
            59  => 'C, E, B',
            60  => 'C, E, D',
            61  => 'D, A, B',
            62  => 'D, A, C',
            63  => 'D, A, E',
            64  => 'D, B, A',
            65  => 'D, B, C',
            66  => 'D, B, E',
            67  => 'D, C, A',
            68  => 'D, C, B',
            69  => 'D, C, E',
            70  => 'D, E, A',
            71  => 'D, E, B',
            72  => 'D, E, C',
            73  => 'E, A, B',
            74  => 'E, A, C',
            75  => 'E, A, D',
            76  => 'E, B, A',
            77  => 'E, B, C',
            78  => 'E, B, D',
            79  => 'E, C, A',
            80  => 'E, C, B',
            81  => 'E, C, D',
            82  => 'E, D, A',
            83  => 'E, D, B',
            84  => 'E, D, C',
            85  => 'A, B, C, D',
            86  => 'A, B, C, E',
            87  => 'A, B, D, C',
            88  => 'A, B, D, E',
            89  => 'A, B, E, C',
            90  => 'A, B, E, D',
            91  => 'A, C, B, D',
            92  => 'A, C, B, E',
            93  => 'A, C, D, B',
            94  => 'A, C, D, E',
            95  => 'A, C, E, B',
            96  => 'A, C, E, D',
            97  => 'A, D, B, C',
            98  => 'A, D, B, E',
            99  => 'A, D, C, B',
            100 => 'A, D, C, E',
            101 => 'A, D, E, B',
            102 => 'A, D, E, C',
            103 => 'A, E, B, C',
            104 => 'A, E, B, D',
            105 => 'A, E, C, B',
            106 => 'A, E, C, D',
            107 => 'A, E, D, B',
            108 => 'A, E, D, C',
            109 => 'B, A, C, D',
            110 => 'B, A, C, E',
            111 => 'B, A, D, C',
            112 => 'B, A, D, E',
            113 => 'B, A, E, C',
            114 => 'B, A, E, D',
            115 => 'B, C, A, D',
            116 => 'B, C, A, E',
            117 => 'B, C, D, A',
            118 => 'B, C, D, E',
            119 => 'B, C, E, A',
            120 => 'B, C, E, D',
            121 => 'B, D, A, C',
            122 => 'B, D, A, E',
            123 => 'B, D, C, A',
            124 => 'B, D, C, E',
            125 => 'B, D, E, A',
            126 => 'B, D, E, C',
            127 => 'B, E, A, C',
            128 => 'B, E, A, D',
            129 => 'B, E, C, A',
            130 => 'B, E, C, D',
            131 => 'B, E, D, A',
            132 => 'B, E, D, C',
            133 => 'C, A, B, D',
            134 => 'C, A, B, E',
            135 => 'C, A, D, B',
            136 => 'C, A, D, E',
            137 => 'C, A, E, B',
            138 => 'C, A, E, D',
            139 => 'C, B, A, D',
            140 => 'C, B, A, E',
            141 => 'C, B, D, A',
            142 => 'C, B, D, E',
            143 => 'C, B, E, A',
            144 => 'C, B, E, D',
            145 => 'C, D, A, B',
            146 => 'C, D, A, E',
            147 => 'C, D, B, A',
            148 => 'C, D, B, E',
            149 => 'C, D, E, A',
            150 => 'C, D, E, B',
            151 => 'C, E, A, B',
            152 => 'C, E, A, D',
            153 => 'C, E, B, A',
            154 => 'C, E, B, D',
            155 => 'C, E, D, A',
            156 => 'C, E, D, B',
            157 => 'D, A, B, C',
            158 => 'D, A, B, E',
            159 => 'D, A, C, B',
            160 => 'D, A, C, E',
            161 => 'D, A, E, B',
            162 => 'D, A, E, C',
            163 => 'D, B, A, C',
            164 => 'D, B, A, E',
            165 => 'D, B, C, A',
            166 => 'D, B, C, E',
            167 => 'D, B, E, A',
            168 => 'D, B, E, C',
            169 => 'D, C, A, B',
            170 => 'D, C, A, E',
            171 => 'D, C, B, A',
            172 => 'D, C, B, E',
            173 => 'D, C, E, A',
            174 => 'D, C, E, B',
            175 => 'D, E, A, B',
            176 => 'D, E, A, C',
            177 => 'D, E, B, A',
            178 => 'D, E, B, C',
            179 => 'D, E, C, A',
            180 => 'D, E, C, B',
            181 => 'E, A, B, C',
            182 => 'E, A, B, D',
            183 => 'E, A, C, B',
            184 => 'E, A, C, D',
            185 => 'E, A, D, B',
            186 => 'E, A, D, C',
            187 => 'E, B, A, C',
            188 => 'E, B, A, D',
            189 => 'E, B, C, A',
            190 => 'E, B, C, D',
            191 => 'E, B, D, A',
            192 => 'E, B, D, C',
            193 => 'E, C, A, B',
            194 => 'E, C, A, D',
            195 => 'E, C, B, A',
            196 => 'E, C, B, D',
            197 => 'E, C, D, A',
            198 => 'E, C, D, B',
            199 => 'E, D, A, B',
            200 => 'E, D, A, C',
            201 => 'E, D, B, A',
            202 => 'E, D, B, C',
            203 => 'E, D, C, A',
            204 => 'E, D, C, B',
            205 => 'A, B, C, D, E',
            206 => 'A, B, C, E, D',
            207 => 'A, B, D, C, E',
            208 => 'A, B, D, E, C',
            209 => 'A, B, E, C, D',
            210 => 'A, B, E, D, C',
            211 => 'A, C, B, D, E',
            212 => 'A, C, B, E, D',
            213 => 'A, C, D, B, E',
            214 => 'A, C, D, E, B',
            215 => 'A, C, E, B, D',
            216 => 'A, C, E, D, B',
            217 => 'A, D, B, C, E',
            218 => 'A, D, B, E, C',
            219 => 'A, D, C, B, E',
            220 => 'A, D, C, E, B',
            221 => 'A, D, E, B, C',
            222 => 'A, D, E, C, B',
            223 => 'A, E, B, C, D',
            224 => 'A, E, B, D, C',
            225 => 'A, E, C, B, D',
            226 => 'A, E, C, D, B',
            227 => 'A, E, D, B, C',
            228 => 'A, E, D, C, B',
            229 => 'B, A, C, D, E',
            230 => 'B, A, C, E, D',
            231 => 'B, A, D, C, E',
            232 => 'B, A, D, E, C',
            233 => 'B, A, E, C, D',
            234 => 'B, A, E, D, C',
            235 => 'B, C, A, D, E',
            236 => 'B, C, A, E, D',
            237 => 'B, C, D, A, E',
            238 => 'B, C, D, E, A',
            239 => 'B, C, E, A, D',
            240 => 'B, C, E, D, A',
            241 => 'B, D, A, C, E',
            242 => 'B, D, A, E, C',
            243 => 'B, D, C, A, E',
            244 => 'B, D, C, E, A',
            245 => 'B, D, E, A, C',
            246 => 'B, D, E, C, A',
            247 => 'B, E, A, C, D',
            248 => 'B, E, A, D, C',
            249 => 'B, E, C, A, D',
            250 => 'B, E, C, D, A',
            251 => 'B, E, D, A, C',
            252 => 'B, E, D, C, A',
            253 => 'C, A, B, D, E',
            254 => 'C, A, B, E, D',
            255 => 'C, A, D, B, E',
            256 => 'C, A, D, E, B',
            257 => 'C, A, E, B, D',
            258 => 'C, A, E, D, B',
            259 => 'C, B, A, D, E',
            260 => 'C, B, A, E, D',
            261 => 'C, B, D, A, E',
            262 => 'C, B, D, E, A',
            263 => 'C, B, E, A, D',
            264 => 'C, B, E, D, A',
            265 => 'C, D, A, B, E',
            266 => 'C, D, A, E, B',
            267 => 'C, D, B, A, E',
            268 => 'C, D, B, E, A',
            269 => 'C, D, E, A, B',
            270 => 'C, D, E, B, A',
            271 => 'C, E, A, B, D',
            272 => 'C, E, A, D, B',
            273 => 'C, E, B, A, D',
            274 => 'C, E, B, D, A',
            275 => 'C, E, D, A, B',
            276 => 'C, E, D, B, A',
            277 => 'D, A, B, C, E',
            278 => 'D, A, B, E, C',
            279 => 'D, A, C, B, E',
            280 => 'D, A, C, E, B',
            281 => 'D, A, E, B, C',
            282 => 'D, A, E, C, B',
            283 => 'D, B, A, C, E',
            284 => 'D, B, A, E, C',
            285 => 'D, B, C, A, E',
            286 => 'D, B, C, E, A',
            287 => 'D, B, E, A, C',
            288 => 'D, B, E, C, A',
            289 => 'D, C, A, B, E',
            290 => 'D, C, A, E, B',
            291 => 'D, C, B, A, E',
            292 => 'D, C, B, E, A',
            293 => 'D, C, E, A, B',
            294 => 'D, C, E, B, A',
            295 => 'D, E, A, B, C',
            296 => 'D, E, A, C, B',
            297 => 'D, E, B, A, C',
            298 => 'D, E, B, C, A',
            299 => 'D, E, C, A, B',
            300 => 'D, E, C, B, A',
            301 => 'E, A, B, C, D',
            302 => 'E, A, B, D, C',
            303 => 'E, A, C, B, D',
            304 => 'E, A, C, D, B',
            305 => 'E, A, D, B, C',
            306 => 'E, A, D, C, B',
            307 => 'E, B, A, C, D',
            308 => 'E, B, A, D, C',
            309 => 'E, B, C, A, D',
            310 => 'E, B, C, D, A',
            311 => 'E, B, D, A, C',
            312 => 'E, B, D, C, A',
            313 => 'E, C, A, B, D',
            314 => 'E, C, A, D, B',
            315 => 'E, C, B, A, D',
            316 => 'E, C, B, D, A',
            317 => 'E, C, D, A, B',
            318 => 'E, C, D, B, A',
            319 => 'E, D, A, B, C',
            320 => 'E, D, A, C, B',
            321 => 'E, D, B, A, C',
            322 => 'E, D, B, C, A',
            323 => 'E, D, C, A, B',
            324 => 'E, D, C, B, A',
        ];

        sort($allPossibilities);

        $generator = new CombinationsGenerator();

        foreach ($generator->generate($items) as $i => $combo) {
            $needle = implode(', ', $combo);
            self::assertContains($needle, $allPossibilities, "An apparently impossible combination was generated: $needle");
            unset($allPossibilities[array_search($needle, $allPossibilities)]);
        }

        self::assertEmpty($allPossibilities, 'At least one possible combination was not generated.');
    }

    public function testStressTestTo9Levels()
    {
        if (!self::isDebugOn()) {
            $this->markTestSkipped('Very intensive');
        }

        $generator = new CombinationsGenerator();
        for ($a = 1; $a <= 10; ++$a) {
            $items = array_slice(range('A', 'Z'), 0, $a);

            if (self::isDebugOn()) {
                dump("Level $a: " . 'Generating combinations for ' . implode(', ', $items));
            }

            $comboCount = 00;
            $timeBefore = microtime(true);
            $memUsageBefore = memory_get_usage();
            $memPeakBefore = memory_get_peak_usage();
            foreach ($generator->generate($items) as $i => $combo) {
                ++$comboCount;
            }
            $timeAfter = microtime(true);
            $memUsageAfter = memory_get_usage();
            $memPeakAfter = memory_get_peak_usage();

            $stats = [
                'Number of possibilities' => $comboCount,
                'Time (ms)              ' => ($timeAfter - $timeBefore) * 1000,
                'Time (s)               ' => ($timeAfter - $timeBefore),
                'Memory consumed        ' => $memUsageAfter - $memUsageBefore,
                'Peak Memory (Diff)     ' => $memPeakAfter - $memPeakBefore,
            ];

            dump($stats);
        }

        self::assertTrue(true);
    }
}
