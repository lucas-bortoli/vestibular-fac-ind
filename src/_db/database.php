<?php
namespace Database;

require_once(__DIR__ . "/Participante.php");
require_once(__DIR__ . "/Campus.php");
require_once(__DIR__ . "/Curso.php");
require_once(__DIR__ . "/Config.php");

$pdo = new \PDO("sqlite:/data/database.sqlite");

// Inicializar schemas
ParticipanteController::init($pdo);
CampusController::init($pdo);
CursoController::init($pdo);
ConfigController::init($pdo);