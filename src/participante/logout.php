<?php

// Destruir a sessão, se existir
if (isset($_SESSION)) {
    session_destroy();
}

// Redirecionar a página principal
header("Location: /");