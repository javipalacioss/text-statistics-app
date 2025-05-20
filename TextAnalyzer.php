<?php

class TextAnalyzer
{
    private $stopwords;

    public function __construct(array $stopwords)
    {
        $this->stopwords = array_map('strtolower', $stopwords);
    }

    public function cleanText(string $text): array
    {
        $text = strtolower($text);
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
        $words = preg_split('/\s+/', $text);

        return array_filter($words, function ($word) {
            return $word !== '' && !in_array($word, $this->stopwords);
        });
    }

    public function countWords(string $text): array
    {
        $words = $this->cleanText($text);
        $counts = [];

        foreach ($words as $word) {
            if (!isset($counts[$word])) {
                $counts[$word] = 0;
            }
            $counts[$word]++;
        }

        arsort($counts);
        return $counts;
    }
}
