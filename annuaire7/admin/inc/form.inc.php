<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Formulaire : Annuaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="contrainer col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <br>
                    <h3 class="text-center">ANNUAIRE</h3>
                    <hr>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3 class="text-center">Affichage des données la base de donnée</h3>
                    <hr>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <td colspan="2" align="center"> Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- AFFICHAGE -->
                            <?php
                                include_once("afficher.inc.php");
                            ?>
                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                                <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><a href="inc/supprimer.inc.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Supprimer</a></td>
                                <td><a href="admin.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Modifier</a></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="text-center">Ajouter une personne</h3>
                    <hr>
                    <form action="" method="post">
                        <div class="tour">
                            <input class="name" type="hidden" name="id"placeholder="id">
                        </div>
                        <div class="tour">
                            <input class="nom" type="text" name="nom" placeholder="Nom" required="">
                        </div>
                        <div class="tour">
                            <input class="prenom" type="text" name="prenom" placeholder="Prenom" required="">
                        </div>
                        <div class="tour">
                            <input class="mail" type="email" name="email" required placeholder="Email" required="">
                        </div>
                            <input class="btn btn-primary" name="btn_ajout" type="submit" value="Ajouter">
                            <!-- INSERT -->
                            <?php
                                include_once("inserer.inc.php");
                            ?>
                        <hr>
                    </form>
                    <nav>
                        <!-- PAGINATION PAR 6 -->
                        <ul class="pagination">
                            <?php 
                                if(isset($_GET['page']) && !empty($_GET['page'])){
                                    $currentPage = (int) strip_tags($_GET['page']);
                                }else{
                                    $currentPage = 1;
                                }
                                try{
                                    $bdd = new PDO("mysql:host=localhost;dbname=annuaire;", "root", "");
                                }
                                catch (Exception $e){
                                    die('Erreur : ' . $e->getMessage());
                                }
                                
                                $sql = "SELECT COUNT(*) AS nb_coordonnees FROM `coordonnees`;";

                                $query = $bdd->prepare($sql);
                                $query->execute();
                                $result = $query->fetch();
            
                                $nbCoordonnees = (int) $result['nb_coordonnees'];
                                $parPage = 6;
                                $pages = ceil($nbCoordonnees / $parPage);
                            ?>
                            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                                <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                            </li>
                            <?php for($page = 1; $page <= $pages; $page++): ?>
                                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                    <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                                </li>
                            <?php endfor ?>
                            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                                <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </body>
</html>