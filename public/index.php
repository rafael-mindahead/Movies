<?php

require_once __DIR__ . '/../src/Database.php'; //carrega aquivo

$database = new Database(); // instancia o metado

$connection =$database->connect();

echo "banco criado com sucesso";

