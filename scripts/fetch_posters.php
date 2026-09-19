<?php

require_once __DIR__ . '/../src/Database.php';

$token = getenv('TMDB_TOKEN');

if (!$token) {
    die("TMDB_TOKEN não encontrado.\n");
}

$database = new Database();
$connection = $database->connect();

$sql = "
    SELECT
        id,
        title
    FROM movies
    ORDER BY id
";

$statement = $connection->prepare($sql);
$statement->execute();

$movies = $statement->fetchAll(PDO::FETCH_ASSOC);

$posterDirectory = __DIR__ . '/../public/images/movies';

if (!is_dir($posterDirectory)) {
    mkdir($posterDirectory, 0777, true);
}

foreach ($movies as $movie) {

    echo "Buscando: {$movie['title']}...\n";

    $query = urlencode($movie['title']);

    $url =
        "https://api.themoviedb.org/3/search/movie"
        . "?query={$query}"
        . "&language=pt-BR"
        . "&region=BR";

    $options = [
        "http" => [
            "method" => "GET",
            "header" => [
                "Authorization: Bearer {$token}",
                "Accept: application/json"
            ]
        ]
    ];

    $context = stream_context_create($options);

    $response = file_get_contents(
        $url,
        false,
        $context
    );

    if ($response === false) {
        echo "Erro ao consultar TMDB.\n\n";
        continue;
    }

    $data = json_decode($response, true);

    if (
        empty($data["results"])
        || empty($data["results"][0]["poster_path"])
    ) {
        echo "Poster não encontrado.\n\n";
        continue;
    }

    $posterPath =
        $data["results"][0]["poster_path"];

    $posterUrl =
        "https://image.tmdb.org/t/p/w500"
        . $posterPath;

    $fileName = generateFileName(
        $movie["title"]
    );

    $localFile =
        $posterDirectory
        . "/"
        . $fileName;

    $image = file_get_contents($posterUrl);

    if ($image === false) {
        echo "Erro ao baixar imagem.\n\n";
        continue;
    }

    file_put_contents(
        $localFile,
        $image
    );

    $databasePath =
        "images/movies/"
        . $fileName;

    $update = $connection->prepare("
        UPDATE movies
        SET poster_path = :poster_path
        WHERE id = :id
    ");

    $update->execute([
        "poster_path" => $databasePath,
        "id" => $movie["id"]
    ]);

    echo "OK: {$databasePath}\n\n";
}


function generateFileName(string $title): string
{
    $title = iconv(
        'UTF-8',
        'ASCII//TRANSLIT',
        $title
    );

    $title = strtolower($title);

    $title = preg_replace(
        '/[^a-z0-9]+/',
        '-',
        $title
    );

    $title = trim(
        $title,
        '-'
    );

    return $title . '.jpg';
}