<?php

require_once __DIR__ . '/../src/Database.php'; //carrega aquivo
require_once __DIR__ . '/../src/MovieRepository.php'; //carrega aquivo

$database = new Database(); // instancia o metado

$connection =$database->connect();

$repository = new MovieRepository($connection); //instancia o objeto MovieRepository, passando a conexao com o banco de dados

$movies = $repository->findAll(); //chama o metodo findAll do objeto MovieRepository, que retorna um array de filmes

foreach ($movies as $movie) { // para cada filme dentro do array $movies, coloque temporariamente aquele filme em $movie.
    echo "<h2>" . $movie["title"] . "</h2>";
    echo "<p>";
    echo $movie["main_tag"];
    echo " | ";
    echo $movie["subtag_1"];
    echo " | ";
    echo $movie["subtag_2"];
    echo "</p>";
}

echo "banco criado com sucesso";

