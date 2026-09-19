<?php

class RecommendationService {
    public function recommed( // recebe dados do usuario, e retorna uma lista de filmes recomendados.
        array $movies, // todos os filmes
        array $topTags, //preferencias do usuario.
        array $viewedMovies, //filmes que ja clicou
        int $limit = 10 // quantos queremos recomendar
    ): array{ // retorna um lista de recomendacoes.
        $recommendedMovies = [];

        $viewedLookup = array_fill_keys(// transforma vistos em um hashmap.
            $viewedMovies,
            true
        );
        foreach ($movies as $movie) { // percorrer todos os filmes, inicialmente 0 (n) = mas, N = NUMERO de filmes 
            if (isset($viewedLookup[$movie["id"]])) { // nao recomenda filmes que o usuario ja clicou.
                continue; // pula para o proximo filme.
            }
        }
        $score = 0;

        $mainTag = $movie["main_tag"];
        $subTag1 = $movie["subtag_1"];
        $subTag2 = $movie["subtag_2"];

        if (isset($topTags[$mainTag])) {
            $score += $topTags[$mainTag] * 2;
        }
        if (isset($topTags[$subTag1])) {
            $score += $topTags[$subTag1];
        }
        if (isset($topTags[$subTag2])) {
            $score += $topTags[$subTag2];
        }
        if ($score > 0) {
            $movie["score"] = $score; // adiciona uma nova chave na array.
            $recommendedMovies[] = $movie;
        }
    }
    usort(
        $recommendations,
        function ($a, $b) { // ordena o array de recomendacoes, em ordem decrescente.
            return $b["score"] <=> $a["score"]; // operador spaceship, retorna -1, 0 ou 1.
        }
    );
    return array_slice(
        $recommendations,
        0,
        $limit
    );
}