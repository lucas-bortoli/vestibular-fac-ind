<?php
require_once "_db/database.php";
require_once "_db/Participante.php";

$dao = new \Database\ParticipanteController($pdo);
$model = new \Database\ParticipanteModel();

$model->nome = "Joacir";
$model->documento = "11111111111";
$model->dataNascimento = "2022-10-12";
$model->email = "joacir@email.com";
$model->cursoId = 11;
$dao->add($model);

$dao->listAll();