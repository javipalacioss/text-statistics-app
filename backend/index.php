<?php
declare(strict_types=1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Ruta a TextAnalyzer.php (carpeta padre)
require_once __DIR__ . '/../TextAnalyzer.php';

// Ruta al stopwords.txt (misma carpeta)
$stopwordsFile = __DIR__ . '/stopwords.txt';
$stopwords = file($stopwordsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($stopwords === false) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo cargar el archivo de stopwords']);
    exit;
}

$analyzer = new TextAnalyzer($stopwords);

$inputText = $_POST['text'] ?? '';

if (trim($inputText) === '') {
    http_response_code(400);
    echo json_encode(['error' => 'El texto no puede estar vacío']);
    exit;
}

try {
    $result = $analyzer->countWords($inputText);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al procesar el texto: ' . $e->getMessage()]);
}
