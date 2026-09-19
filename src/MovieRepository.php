<?php

class MovieRepository {
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection; //PREPARANDO A INJECAO DE DEPEDENCIA
    }
    public function findAll(): array
    {
        $sql = "
            SELECT
                id,
                title,
                main_tag,
                subtag_1,
                subtag_2,
                poster_path
            FROM movies
            ORDER BY title
        ";

        $statement = $this->connection->prepare($sql); //prepara a consulta 

        $statement->execute(); // manda a consulta 

        return $statement->fetchAll(PDO::FETCH_ASSOC); // fetch all retorna todos os resultados da consulta, e o PDO::FETCH_ASSOC 
        //retorna um array associativo.
    }
    public function findById(int $id): ?array // Busca um filme pelo id, retorna um array associativo.
    {
        $sql = "
            SELECT
                id,
                title,
                main_tag,
                subtag_1,
                subtag_2,
                poster_path
            FROM movies
            WHERE id = :id
        ";

        $statement = $this->connection->prepare($sql); //prepara a consulta 

        $statement->execute([
            "id" => $id
        ]); //manda a consulta, passando o id como parametro, para evitar SQL injection

        $movie = $statement->fetch(PDO::FETCH_ASSOC); // fetch retorna o primeiro resultado da consulta, e o PDO::FETCH_ASSOC

        return $movie ?: null; // se o filme for encontrado, retorna o array associativo, caso contrario retorna null
    }
}