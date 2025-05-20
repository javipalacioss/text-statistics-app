<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../TextAnalyzer.php';

final class TextAnalyzerTest extends TestCase
{
    private TextAnalyzer $analyzer;

    protected function setUp(): void
    {
        $stopwords = ['y', 'el', 'la', 'de'];
        $this->analyzer = new TextAnalyzer($stopwords);
    }

    public function testCleanTextRemovesStopwordsAndPunctuation(): void
    {
        $input = "Hola, y el mundo! ¿De verdad?";
        $expected = ['hola', 'mundo', 'verdad'];

        $result = $this->analyzer->cleanText($input);

        $this->assertEquals($expected, array_values($result));
    }

    public function testCountWordsReturnsCorrectCounts(): void
    {
        $input = "Hola hola mundo mundo mundo";
        $expected = ['mundo' => 3, 'hola' => 2];

        $result = $this->analyzer->countWords($input);

        $this->assertEquals($expected, $result);
    }

    public function testCountWordsEmptyString(): void
    {
        $result = $this->analyzer->countWords('');
        $this->assertEquals([], $result);
    }
}
