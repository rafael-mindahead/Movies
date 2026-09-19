<?php

class RecommendationService
{
    public function recommend( // recebe dados do usuario, e retorna uma lista de filmes recomendados.
        array $movies, // peaga todos os filmes.
        array $topTags, // pega as tags prefiridas do usuario.
        array $viewedMovieIds, // pega os ids dos filmes ja visualizados.
        int $limit = 10 // limita a quantidade de filmes recomendados.
    ): array { // retorna um array de filmes recomendados, baseado nas preferencias do usuario, e nos filmes ja visualizados.

        $recommendations = [];

        $viewedLookup = array_fill_keys( // cria um array associativo, com os ids dos filmes ja visualizados, para facilitar a busca.
            $viewedMovieIds,
            true
        );

        foreach ($movies as $movie) { // para cada filme, calcula a pontuacao baseado nas preferencias do usuario, e nos filmes ja visualizados.

            if (isset($viewedLookup[$movie["id"]])) { // verifica se o filme ja foi visualizado pelo usuario, caso sim, ignora o filme e continua para o proximo.
                continue;
            }

            $score = 0; // inicializa a pontuacao do filme, que vai ser calculada baseado nas preferencias do usuario.

            $mainTag = $movie["main_tag"]; // pega a tag principal do filme.
            $subtag1 = $movie["subtag_1"]; // pega a primeira subtag.
            $subtag2 = $movie["subtag_2"]; // pega a segunda subtag.

            if (isset($topTags[$mainTag])) {
                $score += $topTags[$mainTag] * 2;
            }

            if (isset($topTags[$subtag1])) {
                $score += $topTags[$subtag1];
            }

            if (isset($topTags[$subtag2])) {
                $score += $topTags[$subtag2];
            }

            if ($score > 0) { // se a pontuacao do filme for maior que 0, adiciona o filme na lista de recomendacoes.

                $movie["score"] = $score;

                $recommendations[] = $movie;
            }
        }

        usort( // ordena a lista de recomendacoes, baseado na pontuacao do filme, em ordem decrescente.
            $recommendations,

            function ($a, $b) { // compara a pontuacao dos filmes, para ordenar a lista de recomendacoes.
                return $b["score"] <=> $a["score"]; // operador spaceship, retorna -1, 0 ou 1, dependendo se o valor da esquerda é menor, igual ou maior que o valor da direita.
            }
        );

        return array_slice( // retorna um slice do array de recomendacoes, limitado a quantidade de filmes recomendados.
            $recommendations,
            0,
            $limit
        );
    }
}