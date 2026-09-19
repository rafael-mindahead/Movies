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
                subtag_2
            FROM movies
            ORDER BY title
        ";

        $statement = $this->connection->prepare($sql); //prepara a consulta 

        $statement->execute(); // manda a consulta 

        return $statement->fetchAll(PDO::FETCH_ASSOC); // fetch all retorna todos os resultados da consulta, e o PDO::FETCH_ASSOC 
        //retorna um array associativo.
    }
    // 
    // id 1, poderosos chafao, acao, mafia
}