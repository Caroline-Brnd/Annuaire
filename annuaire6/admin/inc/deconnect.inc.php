<?php
    //Deconnexion à la base de données
    session_destroy();
    header('Location: ../admin.php');
    die();
?>