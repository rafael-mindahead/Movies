<?php

require_once __DIR__ . '/../src/RecommendationService.php';

function check(string $name, $expected, $actual): void
{
    if ($expected !== $actual) {
        throw new RuntimeException(
            "$name falhou.\nEsperado: " . var_export($expected, true)
            . "\nRecebido: " . var_export($actual, true)
        );
    }

    echo "OK: $name\n";
}

$movies = [
    [
        'id' => 1,
        'title' => 'Interestelar',
        'main_tag' => 'ficcao',
        'subtag_1' => 'espaco',
        'subtag_2' => 'drama',
    ],
    [
        'id' => 2,
        'title' => 'Blade Runner 2049',
        'main_tag' => 'ficcao',
        'subtag_1' => 'drama',
        'subtag_2' => 'futuro',
    ],
    [
        'id' => 3,
        'title' => 'Duna',
        'main_tag' => 'ficcao',
        'subtag_1' => 'aventura',
        'subtag_2' => 'espaco',
    ],
];

$service = new RecommendationService();

// A ordem das tags é diferente da ordem dos filmes.
// Mesmo assim, os empates devem preservar a ordem do catálogo.
$tags = ['espaco' => 1, 'ficcao' => 1, 'drama' => 1];

$result = $service->recommend($movies, $tags, [1]);

check('Exclusão e ordem dos filmes', [2, 3], array_column($result, 'id'));
check('Pontuação', [3, 3], array_column($result, 'score'));

$expectedMovie = $movies[1];
$expectedMovie['score'] = 3;
check('Preservação dos dados do filme', $expectedMovie, $result[0]);

check(
    'Limite de recomendações',
    [2],
    array_column($service->recommend($movies, $tags, [1], 1), 'id')
);

check('Sem preferências', [], $service->recommend($movies, [], []));
check('Tag desconhecida', [], $service->recommend($movies, ['musica' => 1], []));
check('Todos visualizados', [], $service->recommend($movies, $tags, [1, 2, 3]));
check('Catálogo vazio', [], $service->recommend([], $tags, []));

$result = $service->recommend($movies, ['ficcao' => 2], []);
check('Peso da preferência', [4, 4, 4], array_column($result, 'score'));

$repeatedTagMovie = [[
    'id' => 4,
    'main_tag' => 'ficcao',
    'subtag_1' => 'ficcao',
    'subtag_2' => 'espaco',
]];

$result = $service->recommend($repeatedTagMovie, ['ficcao' => 1], []);
check('Mesma tag em dois campos', [3], array_column($result, 'score'));

echo "\nTodos os 10 testes passaram.\n";