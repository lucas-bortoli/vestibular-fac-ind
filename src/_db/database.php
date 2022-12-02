<?php
namespace Database;

$pdo = new \PDO("sqlite:/data/database.sqlite");

// Inicializar banco de dados
if ($pdo->beginTransaction()) {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS participante (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome VARCHAR(64) NOT NULL,
            email VARCHAR(64) UNIQUE NOT NULL,
            documento VARCHAR(64) UNIQUE NOT NULL,
            tipoDocumento INTEGER NOT NULL,
            nascimento DATE NOT NULL
        );
    ");

    $pdo->commit();
}