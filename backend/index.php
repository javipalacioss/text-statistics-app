<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Función para limpiar y normalizar texto
function cleanText($text, $stopwords)
{
    $text = strtolower($text);
    $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text); // quitar puntuación
    $words = preg_split('/\s+/', $text);

    return array_filter($words, function ($word) use ($stopwords) {
        return $word !== '' && !in_array($word, $stopwords);
    });
}

// Función principal de análisis
function countWords($text, $stopwords)
{
    $words = cleanText($text, $stopwords);
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

// Cargar stopwords
$stopwords = file('stopwords.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$stopwords = array_map('strtolower', $stopwords);

// Leer el cuerpo dependiendo del tipo de contenido
$contentType = $_SERVER["CONTENT_TYPE"] ?? '';
$inputText = '';

if (strpos($contentType, 'application/json') !== false) {
    $data = json_decode(file_get_contents("php://input"), true);
    $inputText = $data['text'] ?? '';
} elseif (strpos($contentType, 'application/x-www-form-urlencoded') !== false) {
    $inputText = $_POST['text'] ?? '';
}

// Procesar y responder
echo json_encode(countWords($inputText, $stopwords), JSON_UNESCAPED_UNICODE);