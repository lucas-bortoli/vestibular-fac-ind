<?php

use Database\ParticipanteController;

session_start();

// Verificar se usuário está logado
if (!isset($_SESSION["userId"])) {
  http_response_code(401); // unauthorized
  header("Location: /");
  die();
}

$userId = $_SESSION["userId"];

require_once(__DIR__ . "/../_db/database.php");
$participanteController = new ParticipanteController($pdo);
$participante = $participanteController->getById($userId);

// Verificar se usuário está logado
if (is_null($participante)) {
  http_response_code(401); // unauthorized
  header("Location: /");
  die();
}

echo file_get_contents(__DIR__ . "/../_partials/header.html");
?>


<main class="main">
  <section class="split-pane participante">
    <div class="pane multiview-pane">

    </div>
    <div class="pane sidebar-pane">
      <div class="header">
        <i class="icon icon-2x user"></i>
        <span class="user-name"><?php echo htmlspecialchars($participante->nome) ?></span>
      </div>
      <a href="?page=info" class="item">
        <i class="icon user-white"></i>
        Meu perfil
      </a>
      <a href="?page=prova-online" class="item <?php echo $participante->provaOnline == true ? "" : "disabled" ?>">
        <i class="icon prova"></i>
        Prova online
      </a>
      <a href="logout.php" class="item exit">
        <i class="icon exit"></i>
        Sair
      </a>
    </div>
  </section>
</main>

<script src="/lib/modal/dialog.js"></script>

<script>
  // Handler de erros do cadastro
  const url = new URL(location.href);

  if (url.searchParams.has("registerOk")) {
    Dialog.show({
      icon: "success",
      hideCloseButton: true,
      title: "Cadastro realizado",
      message: "O cadastro foi confirmado! Verifique o edital para obter informações a respeito da prova.<br><br>Um e-mail também foi enviado confirmando a inscrição.",
    });
  }
</script>


<?php echo file_get_contents(__DIR__ . "/../_partials/footer.html") ?>