<?php
// on demarre la session
session_start();

require_once('connect.php');

//ecrire la requete sql
$sql ='SELECT * FROM `liste`';

// prepare la requete.
$query=$db->prepare($sql);

// execute la requete.
$query->execute();

// On stocke les resultats dans un tableau associatif.
$result=$query->fetchAll(PDO::FETCH_ASSOC);

// var_dump permet de verifier les donnees sont bien stocker.

//-> var_dump($result);

require_once('close.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">

</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if(!empty($_SESSION['erreur'])){
                    echo '<div class="alert alert-danger" role="alert">
                         '.$_SESSION['erreur'].'
                    
                    </div>';
                    $_SESSION['erreur']="";
                }
                ?>

                <?php
                if(!empty($_SESSION['message'])){
                    echo '<div class="alert alert-success" role="alert">
                         '.$_SESSION['message'].'
                    
                    </div>';
                    $_SESSION['message']="";
                }
                ?>
                <h1>liste des produits</h1>
            <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Nombre</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        // on boucle sur la variable result.
                          foreach($result as $produit){
                        ?>
                        <tr>
                            <td><?=$produit['id']?></td>
                            <td><?=$produit['produit']?></td>
                            <td><?=$produit['prix']?></td>
                            <td><?=$produit['nombre']?></td>
                            <td><a href="details.php?id=<?=$produit['id']?>">Voir</a>
                                <a href="edit.php?id=<?=$produit['id']?>">Modifier</a>
                                <a href="delete.php?id=<?=$produit['id']?>">Supprimer</a>
                        </td>

                        </tr>
                        <?php
                          }
                        ?>
                    </tbody>
            </table>
            <a href="add.php" class="btn btn-primary">
                Ajouter un produit
            </a>
            </section>
        </div>
    </main>
</body>
</html>