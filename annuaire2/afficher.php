<?php
    include_once("form.html");
    
    //Connexion à la base de données
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=annuaire;", "root", "");
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    
    //Préparation de la requête et exécution
    $sql = "SELECT * FROM coordonnees";

    $stmt = $bdd->query($sql);
?>