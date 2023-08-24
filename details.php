<?php
// on demarre la session
session_start();


if(isset($_GET['id'])&& !empty($_GET['id'])){
    require_once('connect.php');

    // on nettoie l'id envoyé.
    $id=strip_tags($_GET['id']);

    // on ecrit la requete (sql)
    $sql='SELECT * FROM `liste` WHERE `id`=:id';

    // on prepare la requete.
    $query=$db->prepare($sql);

    // On accroche les params (id)
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    
    // on execute la requete.
    $query->execute();

    // recupere le produit
    $produit=$query->fetch();

    // on verifie si le produit existe.
    if(!$produit){
        $_SESSION['erreur']="ID inexistant !";
        header('Location: index.php');
    }
}else{
    $_SESSION['erreur']= 'URL invalide';
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails du produit <?php echo $produit['produit'] ?></h1>

                <p>ID: <?=$produit['id']?></p>
                <p>Produit: <?=$produit['produit']?></p>
                <p>Prix: <?=$produit['prix']?></p>
                <p>Nombre: <?=$produit['nombre']?> </p>
                <p>
                    <a class="btn btn-primary" href="index.php">Retour</a>
                    <a class="btn btn-primary" href="edit.php?id=<?=$produit['id']?>">modifier</a>
                </p>
            </section>
        </div>
    </main>
</body>
</html>