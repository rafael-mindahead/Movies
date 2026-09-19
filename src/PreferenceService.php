<?php

class PreferenceService {
    public function addMovie(array $movie): void
    {
        if (!isset($_SESSION['preferences'])) { // verifica se a variavel de sessao existe, caso nao exista, cria um array vazio
            $_SESSION['preferences'] = []; // variavel de sessao, que vai armazenar as preferencias do usuario, caso nao exista, cria um array vazio
            //superglobal $_SESSION, que é um array associativo que armazena variáveis de sessão. 
        }
        $tags = [ // array de tags do filme, que vai ser usado para atualizar as preferencias do usuario
            $movie['main_tag'], // pega a tag principal do filme
            $movie['subtag_1'], // pega a primeira subtag do filme
            $movie['subtag_2'] // pega a segunda subtag do filme
        ];
        foreach ($tags as $tag) { // para cada tag do filme, atualiza a preferencia do usuario
            if (!isset($_SESSION['preferences'][$tag])) { // verifica se a tag ja existe nas preferencias do usuario, caso nao exista, cria a tag com valor 0
                $_SESSION['preferences'][$tag] = 0; // inicializa a tag com valor 0, caso nao exista
            }
            $_SESSION['preferences'][$tag]++; // incrementa a preferencia do usuario para aquela tag, caso ja exista, incrementa o valor em 1
        }
        $_SESSION["viewed_movies"][$movie["id"]] = true; // adiciona o id do filme ao array de filmes visualizados pelo usuario, para evitar que o usuario clique no mesmo filme varias vezes
    }
    public function getTopTags(int $limit = 3): array // metodo que retorna as tags mais preferidas pelo usuario, ordenadas por ordem decrescente, e limitadas a 3 tags
    {
        $preferences = $_SESSION['preferences'] ?? []; // pega as preferencias do usuario, caso nao exista, cria um array vazio

        arsort($preferences); // ordena o array de preferencias do usuario, em ordem decrescente, mantendo a associacao entre chave e valor

        return array_slice( // retorna um slice do array de preferencias do usuario.
            $preferences, // o array de preferencias do usuario
            0, // o indice inicial do slice, que por padrao é 0
            $limit,// o limite de tags a serem retornadas, que por padrao é 3
            true // preserva as chaves do array, para manter a associacao entre chave e valor
        );
    }
    public function getViewedMoviesIds(): array // metodo que retorna os filmes visualizados pelo usuario, caso nao exista, cria um array vazio
    {
        return array_keys($_SESSION["viewed_movies"]?? []);
    } // retorna um array com os ids dos filmes visualizados pelo usuario, caso nao exista, cria um array vazio
}