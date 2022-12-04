<?php

use Database\ParticipanteController;

// Essa página é acessada via POST, após o usuário fazer a submissão do formulário
// de inscrição do vestibular, na página principal.

$cpf = $_POST["cpf"];
$dataNascimento = $_POST["dataNascimento"];

// Verificar se parâmetros não existem
if (!isset($cpf, $dataNascimento)) {
    http_response_code(401);
    header("Location: /?error=authError1");
    die();
}

// Filtrar caracteres indesejados
$cpf = str_replace([".", "-", " "], "", $cpf);

if (strlen($cpf) != 11) {
    http_response_code(401);
    header("Location: /?error=authError2");
    die();
}

require_once(__DIR__ . "/../_db/database.php");

$participanteController = new ParticipanteController($pdo);

$userId = $participanteController->login($cpf, $dataNascimento);

// Verificar se autenticação falhou ($userId == null)
if (!isset($userId)) {
    http_response_code(401);
    header("Location: /?error=authError3");
    die();
}

session_start();

$_SESSION["userId"] = $userId;

header("Location: /participante");