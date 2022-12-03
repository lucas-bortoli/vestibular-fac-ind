<?php echo file_get_contents(__DIR__ . "/../_partials/header.html") ?>

<main class="main">
  <section class="split-pane participante">
    <div class="pane sidebar-pane">
        <div class="header">
          <i class="icon icon-2x user"></i>
          <span class="user-name">Lucas</span>
        </div>
        <a href="?page=info" class="item">
          <i class="icon user-white"></i>
          Meu perfil
        </a>
        <a href="?page=prova-online" class="item">
          <i class="icon prova"></i>
          Prova online
        </a>
        <a href="logout.php" class="item exit">
          <i class="icon exit"></i>
          Sair
        </a>
    </div>
    <div class="pane multiview-pane">
    
    </div>
  </section>
</main>

<?php echo file_get_contents(__DIR__ . "/../_partials/footer.html") ?>