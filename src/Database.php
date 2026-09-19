<?php
//orientando objetos do banco
class Database {
    private string $host = 'mysql';
    private string $database = 'movie_recommender';
    private string $username = 'movie';
    private string $password = 'movie123';

    //metodo acesivel externamente, metodo connect , PDO essa funcao retorna um objeto PDO, chamado php data object 
    public function connect(): PDO 
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";
        //instancia um objeto PDO, passando o dsm, username e password, e retornado o objeto PDO
        return new PDO(
            $dsn,
            $this->username,
            $this->password
        );
    }
}