<?php

require_once __DIR__ . '/../src/Database.php'; //carrega aquivo
require_once __DIR__ . '/../src/MovieRepository.php'; //carrega aquivo
require_once __DIR__ . '/../src/PreferenceService.php'; //carrega aquivo
require_once __DIR__ . '/../src/RecommendationService.php'; //carrega arquivo

$database = new Database(); // instancia o metado

$connection =$database->connect();

$repository = new MovieRepository($connection); //instancia o objeto MovieRepository, passando a conexao com o banco de dados

$preferenceService = new PreferenceService(); //instancia o objeto PreferenceService, que vai ser usado para adicionar as preferencias do usuario

$recommendationService = new RecommendationService(); //instancia o objeto RecommendationService, que vai ser usado para recomendar filmes para o usuario


if($_SESSION["REQUEST_METHOD"] === "POST") { // verifica se o metodo da requisicao é POST, para adicionar as preferencias do usuario
    $movieId = $_POST["movie_id"]; // pega o id do filme que foi clicado pelo usuario, e armazena na variavel $movieId

    $movie = $repository->findById($movieId); // chama o metodo findById do objeto MovieRepository, passando o id do filme, que retorna um array associativo com as informacoes do filme

    if ($movie) {
        $preferenceService->addMovie($movie); // chama o metodo addMovie do objeto PreferenceService, passando o array associativo com as informacoes 
    }
}

$movies = $repository->findAll(); //chama o metodo findAll do objeto MovieRepository, que retorna um array de filmes

$topTags = $preferenceService->getTopTags();

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Movie Recommender</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header>

    <h1>Movie Recommender</h1>

    <p>
        Sistema experimental de recomendação
    </p>

</header>

<div class="container">
    <section class="profile">

        <h2>Seu perfil</h2>

        <?php if (empty($topTags)): ?>

            <p>
                Clique em alguns filmes para começar.
            </p>

        <?php else: ?>

            <?php foreach ($topTags as $tag => $score): ?>

                <p>
                    <?= htmlspecialchars($tag) ?>
                    →
                    <?= $score ?>
                </p>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>

    <div class="movies">

        <?php foreach ($movies as $movie): ?>

            <div class="movie">

                <h2>
                    <?= htmlspecialchars($movie["title"]) ?>
                </h2>

                <div class="tags">

                    <?= htmlspecialchars($movie["main_tag"]) ?>

                    •

                    <?= htmlspecialchars($movie["subtag_1"]) ?>

                    •

                    <?= htmlspecialchars($movie["subtag_2"]) ?>

                </div>

                <br>

                <button>
                    <form method="POST">
                        <input
                            type="hidden"
                            name="movie_id"
                            value="<?= $movie["id"] ?>"
                        >
                        <button type="submit">
                            Visualizar
                        </button>
                    </form>
                </button>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>

</html>

