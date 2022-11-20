<?php
require_once "_db/database.php";
require_once "_db/dao/Participante.php";
require_once "_db/model/Participante.php";

$dao = new \Database\DAO\ParticipanteDAO($pdo);
$model = new \Database\Model\ParticipanteModel();

$model->nome = "Joacir";
$model->documento = "11111111111";
$model->tipoDocumento = 0;
$model->dataNascimento = "2022-10-12";
$model->email = "joacir@email.com";

$dao->add($model);

$dao->listAll();