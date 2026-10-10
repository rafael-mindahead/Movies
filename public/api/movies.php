<?php

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../../src/Database.php';
require_once __DIR__ . '/../../src/MovieRepository.php';

try {

    $database = new Database();

    $connection = $database->connect();

    $repository = new MovieRepository($connection);

    $movies = $repository->findAll();


    $protocol =
        (!empty($_SERVER["HTTPS"])
        && $_SERVER["HTTPS"] !== "off")
        ? "https"
        : "http";


    $host = $_SERVER["HTTP_HOST"];

    $baseUrl =
        $protocol
        . "://"
        . $host
        . "/public/";
    $data = [];

    foreach ($movies as $movie) {

        $data[] = [

            "id" => (int) $movie["id"],

            "title" => $movie["title"],

            "main_tag" => $movie["main_tag"],

            "subtag_1" => $movie["subtag_1"],

            "subtag_2" => $movie["subtag_2"],

            "poster_url" =>
                $movie["poster_path"]
                ? $baseUrl . $movie["poster_path"]
                : null
        ];
    }
    echo json_encode(
        [
            "count" => count($data),
            "data" => $data
        ],
        JSON_UNESCAPED_UNICODE
        | JSON_UNESCAPED_SLASHES
    );

} catch (Throwable $error) {

    http_response_code(500);

    echo json_encode([
        "error" => "Internal server error"
    ]);
}