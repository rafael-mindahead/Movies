<?php
session_start(); // inicia a sessao do usuario, para armazenar as preferencias do usuario

require_once __DIR__ . '/../src/Database.php'; //carrega aquivo
require_once __DIR__ . '/../src/MovieRepository.php'; //carrega aquivo
require_once __DIR__ . '/../src/PreferenceService.php'; //carrega aquivo
require_once __DIR__ . '/../src/RecommendationService.php'; //carrega arquivo

$database = new Database(); // instancia o metado

$connection =$database->connect();

$repository = new MovieRepository($connection); //instancia o objeto MovieRepository, passando a conexao com o banco de dados

$preferenceService = new PreferenceService(); //instancia o objeto PreferenceService, que vai ser usado para adicionar as preferencias do usuario

$recommendationService = new RecommendationService(); //instancia o objeto RecommendationService, que vai ser usado para recomendar filmes para o usuario


if($_SERVER["REQUEST_METHOD"] === "POST") { // verifica se o metodo da requisicao é POST, para adicionar as preferencias do usuario
    $movieId = (int )($_POST["movie_id"] ?? 0); // pega o id do filme que foi clicado pelo usuario, e armazena na variavel $movieId

    $movie = $repository->findById($movieId); // chama o metodo findById do objeto MovieRepository, passando o id do filme, que retorna um array associativo com as informacoes do filme

    if ($movie) {
        $preferenceService->addMovie($movie); // chama o metodo addMovie do objeto PreferenceService, passando o array associativo com as informacoes 
    }
    header("location: index.php"); // redireciona o usuario para a pagina inicial, apos adicionar as preferencias do usuario
    exit;
}

$movies = $repository->findAll(); //chama o metodo findAll do objeto MovieRepository, que retorna um array de filmes

$topTags = $preferenceService->getTopTags(); // chama o metodo getTopTags do objeto PreferenceService.

$viewedMoviesIds = $preferenceService->getViewedMoviesIds();// chama o metodo getViewedMovieIds do objeto PreferenceService.

$recommendation = $recommendationService->recommend( // chama o metodo recommend do objeto RecommendationService.
    $movies,// passa o array de filmes, que vai ser usado para recomendar filmes.
    $topTags, // passa o array de tags preferidas do usuario.
    $viewedMoviesIds,// passa o array de ids dos filmes ja visualizados.
    10// passa o limite de filmes recomendados.
);

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

<header class="main-header">
    <div class="header-content">

        <div>
            <h1>Movie Recommender</h1>

            <p>
                Descubra filmes com base nas suas preferências.
            </p>
        </div>

    </div>
</header>


<main class="container">

    <section class="profile-section">

        <div class="section-header">
            <div>
                <span class="section-label">
                    PERFIL
                </span>

                <h2>
                    Suas preferências
                </h2>
            </div>
        </div>

        <?php if (empty($topTags)): ?>

            <div class="empty-state">
                <p>
                    Clique em alguns filmes para o algoritmo começar a entender seus interesses.
                </p>
            </div>

        <?php else: ?>

            <div class="preferences">

                <?php foreach ($topTags as $tag => $score): ?>

                    <div class="preference-tag">

                        <span>
                            <?= htmlspecialchars($tag) ?>
                        </span>

                        <strong>
                            <?= $score ?>
                        </strong>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </section>


    <?php if (!empty($recommendation)): ?>

        <section class="catalog-section">

            <div class="section-header">

                <div>
                    <span class="section-label">
                        PARA VOCÊ
                    </span>

                    <h2>
                        Recomendações
                    </h2>
                </div>

            </div>


            <div class="movies">

                <?php foreach ($recommendation as $movie): ?>

                    <?php
                    $poster = $movie["poster_path"]
                        ?: "images/movies/placeholder.jpg";
                    ?>

                    <article class="movie">

                        <div class="poster-wrapper">

                            <img
                                src="<?= htmlspecialchars($poster) ?>"
                                alt="<?= htmlspecialchars($movie["title"]) ?>"
                                class="movie-poster"
                            >

                            <?php if (isset($movie["score"])): ?>

                                <div class="score-badge">
                                    <?= $movie["score"] ?>
                                </div>

                            <?php endif; ?>

                        </div>


                        <div class="movie-content">

                            <h3 class="movie-title">
                                <?= htmlspecialchars($movie["title"]) ?>
                            </h3>


                            <div class="tags">

                                <span>
                                    <?= htmlspecialchars($movie["main_tag"]) ?>
                                </span>

                                <span>
                                    <?= htmlspecialchars($movie["subtag_1"]) ?>
                                </span>

                                <span>
                                    <?= htmlspecialchars($movie["subtag_2"]) ?>
                                </span>

                            </div>


                            <form method="POST">

                                <input
                                    type="hidden"
                                    name="movie_id"
                                    value="<?= $movie["id"] ?>"
                                >

                                <button
                                    type="submit"
                                    class="movie-button"
                                >
                                    Visualizar
                                </button>

                            </form>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </section>

    <?php endif; ?>


    <section class="catalog-section">

        <div class="section-header">

            <div>
                <span class="section-label">
                    CATÁLOGO
                </span>

                <h2>
                    Todos os filmes
                </h2>
            </div>

            <span class="movie-count">
                <?= count($movies) ?> filmes
            </span>

        </div>


        <div class="movies">

            <?php foreach ($movies as $movie): ?>

                <?php
                $poster = $movie["poster_path"]
                    ?: "images/movies/placeholder.jpg";
                ?>

                <article class="movie">

                    <div class="poster-wrapper">

                        <img
                            src="<?= htmlspecialchars($poster) ?>"
                            alt="<?= htmlspecialchars($movie["title"]) ?>"
                            class="movie-poster"
                        >

                    </div>


                    <div class="movie-content">

                        <h3 class="movie-title">
                            <?= htmlspecialchars($movie["title"]) ?>
                        </h3>


                        <div class="tags">

                            <span>
                                <?= htmlspecialchars($movie["main_tag"]) ?>
                            </span>

                            <span>
                                <?= htmlspecialchars($movie["subtag_1"]) ?>
                            </span>

                            <span>
                                <?= htmlspecialchars($movie["subtag_2"]) ?>
                            </span>

                        </div>


                        <form method="POST">

                            <input
                                type="hidden"
                                name="movie_id"
                                value="<?= $movie["id"] ?>"
                            >

                            <button
                                type="submit"
                                class="movie-button"
                            >
                                Visualizar
                            </button>

                        </form>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </section>

</main>


<footer class="footer">
    <p>
        Movie Recommender • PHP + MySQL + Docker
    </p>

    <p class="tmdb-credit">
        This product uses the TMDB API but is not endorsed or certified by TMDB.
    </p>
</footer>

</body>

</html>