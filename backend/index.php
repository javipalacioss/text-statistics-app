<?php

// Lista de stopwords comunes en español
$stopwords = file('stopwords.txt', FILE_IGNORE_NEW_LINES);

function cleanText($text) {
    // Elimina puntuación
    $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
    return mb_strtolower($text, 'UTF-8');
}

function countWords($text, $stopwords) {
    $text = cleanText($text);
    $words = preg_split('/\s+/', $text);
    $counts = [];

    foreach ($words as $word) {
        if ($word === '' || in_array($word, $stopwords)) continue;
        if (!isset($counts[$word])) $counts[$word] = 0;
        $counts[$word]++;
    }

    arsort($counts);
    return $counts;
}

// Obtener texto del POST
$input = json_decode(file_get_contents('php://input'), true);
$text = $input['text'] ?? '';
$results = countWords($text, $stopwords);

// Respuesta en JSON
header('Content-Type: application/json');
echo json_encode($results);