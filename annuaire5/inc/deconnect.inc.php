<?php
    //Deconnexion à la base de données
    session_destroy();
    header('Location: ../annuaire.php');
    die();
?>