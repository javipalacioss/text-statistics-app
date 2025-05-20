<?php
namespace Backend;

class TextStatistics
{
    private array $words;

    public function __construct(array $words)
    {
        $this->words = $words;
    }

    public function totalWords(): int
    {
        return count($this->words);
    }

    public function uniqueWords(): int
    {
        return count(array_unique($this->words));
    }

    public function mostCommonWords(int $topN = 10): array
    {
        $counts = array_count_values($this->words);
        arsort($counts);
        return array_slice($counts, 0, $topN, true);
    }
}
