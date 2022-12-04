<?php
use Database\CursoController;
use Database\ParticipanteController;
use Database\ParticipanteModel;

// Essa página é acessada via POST, após o usuário fazer a submissão do formulário
// de inscrição do vestibular, na página principal.

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$dataNascimento = $_POST["dataNascimento"];
$curso = $_POST["curso"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$modalidade = $_POST["modalidade"];

// Verificar se parâmetros não existem
if (!isset($nome, $cpf, $dataNascimento, $curso, $email, $telefone, $modalidade)) {
    http_response_code(400);
    header("Location: /?error=parameter");
    die();
}

// Filtrar caracteres indesejados
$cpf = str_replace([".", "-", " "], "", $cpf);
$telefone = str_replace([".", "-", " ", "(", ")"], "", $cpf);

if (strlen($cpf) != 11) {
    http_response_code(400);
    header("Location: /?error=cpf");
    die();
} else if (strlen($telefone) != 11) {
    http_response_code(400);
    header("Location: /?error=telefone");
    die();
}

require_once(__DIR__ . "/../_db/database.php");

$participanteController = new ParticipanteController($pdo);

$participante = new ParticipanteModel();
$participante->nome = $nome;
$participante->documento = $cpf;
$participante->dataNascimento = $dataNascimento;
$participante->email = $email;
$participante->cursoId = $curso;
$participante->provaOnline = $modalidade == "online";

try {
    $userId = $participanteController->add($participante);

    session_start();
    
    $_SESSION["userId"] = $userId;

    header("Location: /participante?registerOk");
} catch (\Exception $th) {
    http_response_code(400);
    header("Location: /?error=registerError");
}