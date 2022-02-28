<?php
    //Supprimer une coordonnée
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        //Connexion à la base de données
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=annuaire;", "root", "");
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        //Préparation de la requête et exécution
        $req = "DELETE FROM coordonnees WHERE id='$id'";

        $d = $bdd->prepare($req);
        $d->bindParam(":id", $id);
        $d->execute();

        //Refresh la page
        header("refresh:1; url=../admin.php");
    }
?>