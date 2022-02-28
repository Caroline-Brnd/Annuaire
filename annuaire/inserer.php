<?php
    include_once("form.html");

    //Ajouter une coordonnée
    if(isset($_POST['nom'], $_POST['prenom'], $_POST['email'],)) {
        //Récupérer les champs
        $name = $_POST['nom'];
        $ft_name = $_POST['prenom'];
        $email = $_POST['email'];
                    
        //Connexion à la base de données
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=annuaire;", "root", "");
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
        //Préparation de la requête et exécution
        $query = "INSERT INTO coordonnees(nom, prenom, email) VALUES(:nom, :prenom, :email)";

        
        $q = $bdd->prepare($query);
        $q->bindParam(":nom", $name);
        $q->bindParam(":prenom", $ft_name);
        $q->bindParam(":email", $email);
        $q->execute();
    }
?>