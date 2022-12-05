<h2>Meu perfil</h2>

<div class="field">
    <label>Nome<label>
    <span class="detalhes"><?php echo htmlspecialchars($participante->nome) ?></span>
</div>
<div class="field">
    <label>E-mail<label>
    <span class="detalhes"><?php echo htmlspecialchars($participante->email) ?></span>
</div>
<div class="field">
    <label>CPF<label>
    <span class="detalhes" id="cpf"><?php echo htmlspecialchars($participante->documento) ?></span>
</div>
<div class="field">
<?php
use Database\CursoController;
use Database\CampusCursoModel;

require_once(__DIR__ . "/../../_db/database.php");

$cursoController = new CursoController($pdo);

$listaCursos = $cursoController->listAllWithCampus();

// Enviado para o cliente logo abaixo
$cursoNome = "";
$campusNome = "";

foreach ($listaCursos as $curso) {
    if ($curso->cursoId == $participante->cursoId) {
        $cursoNome = $curso->cursoNome;
        $campusNome = $curso->campusNome;
        break;
    }
}

?>

</div>
<div class="field">
    <label>Curso selecionado<label><br>
    <span class="detalhes"><?php echo htmlspecialchars($cursoNome) ?></span>
    <span class="detalhes"><?php echo htmlspecialchars($campusNome) ?></span>
</div>

<div class="field">
    <label>Modalidade de prova<label><br>
    <span class="detalhes"><?php echo $participante->provaOnline ? "Online" : "Presencial - concurso de bolsas" ?></span>
</div>

<style>
.field {
    margin-bottom: 1rem;
}

.detalhes {
    font-size: 0.8rem;
    color: rgb(109, 109, 109);
    display: block;
}
</style>

<script src="/js/formatos.js"></script>
<script>
const cpfInput = document.querySelector(".field #cpf");

cpfInput.innerText = formatarCpf(cpfInput.innerText).formato;
</script>