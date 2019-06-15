# Combinatorics

[![TravisCI](https://travis-ci.org/phpexpertsinc/Combinatorics.svg?branch=master)](https://travis-ci.org/phpexpertsinc/Combinatorics)
[![Maintainability](https://api.codeclimate.com/v1/badges/cb607de8292ed5b208ae/maintainability)](https://codeclimate.com/github/phpexpertsinc/Combinatorics/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/cb607de8292ed5b208ae/test_coverage)](https://codeclimate.com/github/phpexpertsinc/Combinatorics/test_coverage)

Combinatorics is a PHP Experts, Inc., Project meant for the ease of access of Combinatorics algorithms.

See https://en.wikipedia.org/wiki/Combinatorics

### Memory Consumption
Storing thousands of possibilities can be extremely memory intensive. 

However, this project utilizes PHP Generators and uses only a few kilobytes to calculate and output
millions of potential combinations (See the **Benchmarks** section below).

### Generating All Possible Combinations

What are all the possibilities of A, B, C and D? More than you might think! 64. 
Add two more letters and you've got 1,956 possibilities. 

How many different parking spot orderings can 8 cars occupy on any given day? 
Find out in the **Usage** section below!  

## Installation

Via Composer

```bash
composer require phpexperts/combinatorics
```

## Usage
```php
$generator = new CombinationsGenerator();

foreach ($generator->generate($styles) as $combination) {
    // If you can do what you need to do with the combinations here, without immediately storing
    // them into an array, then your memory usage will never exceed the amount needed store one 
    // combination.
}
```

You can see real-world usage of this project in the test suite of the 
**Console Painter project**](https://github.com/PHPExpertsInc/ConsolePainter).

## Use cases

## Testing

```bash
phpunit --testdox
```

To actually see what's going on -and- run the stress tests, run

```bash
phpunit --debug
```

Note: It takes over 5 minutes on an Intel i7 to run all of the stress tests.

## Benchmarks

```php
Level 1: Generating combinations for A
[
  Number of possibilities => 2
  Time (ms)               => 0.051975250244141
  Time (s)                => 5.1975250244141E-5
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 2: Generating combinations for A, B
[
  Number of possibilities => 4
  Time (ms)               => 0.047922134399414
  Time (s)                => 4.7922134399414E-5
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 3: Generating combinations for A, B, C
[
  Number of possibilities => 15
  Time (ms)               => 0.22578239440918
  Time (s)                => 0.00022578239440918
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 4: Generating combinations for A, B, C, D
[
  Number of possibilities => 64
  Time (ms)               => 1.0910034179688
  Time (s)                => 0.0010910034179688
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 5: Generating combinations for A, B, C, D, E
[
  Number of possibilities => 325
  Time (ms)               => 6.5748691558838
  Time (s)                => 0.0065748691558838
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 6: Generating combinations for A, B, C, D, E, F
[
  Number of possibilities => 1956
  Time (ms)               => 47.721147537231
  Time (s)                => 0.047721147537231
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 7: Generating combinations for A, B, C, D, E, F, G
[
  Number of possibilities => 13699
  Time (ms)               => 395.29585838318
  Time (s)                => 0.39529585838318
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 8: Generating combinations for A, B, C, D, E, F, G, H
[
  Number of possibilities => 109600
  Time (ms)               => 3834.4430923462
  Time (s)                => 3.8344430923462
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
Level 9: Generating combinations for A, B, C, D, E, F, G, H, I
[
  Number of possibilities => 986409
  Time (ms)               => 37884.353876114
  Time (s)                => 37.884353876114
  Memory consumed         => 320
  Peak Memory (Diff)      => 0
]
Level 10: Generating combinations for A, B, C, D, E, F, G, H, I, J
[
  Number of possibilities => 9864100
  Time (ms)               => 422606.03785515
  Time (s)                => 422.60603785515
  Memory consumed         => 0
  Peak Memory (Diff)      => 0
]
```

## Contributors

[Theodore R. Smith](https://www.phpexperts.pro/]) <theodore@phpexperts.pro>  
GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690  
CEO: PHP Experts, Inc.

## License

MIT license. Please see the [license file](LICENSE) for more information.

