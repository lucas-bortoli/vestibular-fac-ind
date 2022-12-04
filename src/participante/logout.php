<?php

// Destruir a sessão, se existir
session_start();
session_destroy();

// Redirecionar a página principal
header("Location: /");