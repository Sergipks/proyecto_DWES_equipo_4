<?php
    session_start();
    $_SESSION['perfil']=null;
    session_destroy();
    header("Location: ../index.php");
?>