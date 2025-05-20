<?php

use PHPUnit\Framework\TestCase;
use Backend\TextStatistics;

final class TextStatisticsTest extends TestCase
{
    public function testEmptyWords(): void
    {
        $stats = new TextStatistics([]);
        $this->assertSame(0, $stats->totalWords());
        $this->assertSame(0, $stats->uniqueWords());
        $this->assertSame([], $stats->mostCommonWords());
    }

    public function testTotalWords(): void
    {
        $words = ['a', 'b', 'c'];
        $stats = new TextStatistics($words);
        $this->assertSame(3, $stats->totalWords());
    }

    public function testUniqueWords(): void
    {
        $words = ['a', 'b', 'a', 'c', 'b'];
        $stats = new TextStatistics($words);
        $this->assertSame(3, $stats->uniqueWords());
    }

    public function testMostCommonWordsDefaultTop(): void
    {
        $words = ['php', 'php', 'test', 'php', 'hello', 'test', 'hello', 'world'];
        $stats = new TextStatistics($words);

        $expected = [
            'php' => 3,
            'test' => 2,
            'hello' => 2,
            'world' => 1
        ];
        $this->assertSame($expected, $stats->mostCommonWords());
    }

    public function testMostCommonWordsWithTopN(): void
    {
        $words = ['one', 'two', 'two', 'three', 'three', 'three'];
        $stats = new TextStatistics($words);

        $expectedTop1 = ['three' => 3];
        $this->assertSame($expectedTop1, $stats->mostCommonWords(1));

        $expectedTop2 = ['three' => 3, 'two' => 2];
        $this->assertSame($expectedTop2, $stats->mostCommonWords(2));
    }

    public function testMostCommonWordsTopZero(): void
    {
        $words = ['a', 'a', 'b'];
        $stats = new TextStatistics($words);

        $this->assertSame([], $stats->mostCommonWords(0));
    }

    public function testMostCommonWordsTopGreaterThanTotal(): void
    {
        $words = ['x', 'y', 'z'];
        $stats = new TextStatistics($words);

        $expected = ['x' => 1, 'y' => 1, 'z' => 1];
        $this->assertSame($expected, $stats->mostCommonWords(10));
    }
}
