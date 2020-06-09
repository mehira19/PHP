<?php
    set_include_path('..'.PATH_SEPARATOR);
    require_once('lib/common_service.php');
    require_once('lib/session_start.php');
    
    if (!isset($_SESSION['ident'])){
      produceError("Vous devez être connecté");
      return;
    }
    $login = $_SESSION['ident'];
    session_destroy();
    produceResult($login);
?>
