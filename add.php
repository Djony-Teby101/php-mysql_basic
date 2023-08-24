<?php
// on demarre la session
session_start();

if($_POST){
    if(isset($_POST['produit']) && !empty($_POST['produit'])
        && isset($_POST['prix']) && !empty($_POST['prix'])
        && isset($_POST['nombre']) && !empty($_POST['nombre'])
       ){
        // On inclut la connexion a la base.
        require_once('connect.php');

        // On nettoie les données envoyees.
        $produit=strip_tags($_POST['produit']);
        $prix=strip_tags($_POST['prix']);
        $nombre=strip_tags($_POST['nombre']);

        $sql='INSERT INTO `liste`(`produit`,`prix`,`nombre`) VALUES
        (:produit,:prix,:nombre);';

        $query=$db->prepare($sql);

        $query->bindValue(':produit',$produit, PDO::PARAM_STR);
        $query->bindValue(':prix',$prix, PDO::PARAM_STR);
        $query->bindValue(':nombre',$nombre, PDO::PARAM_INT);

        $query->execute();
        $_SESSION['message']= "Produit ajouté";
        header('Location: index.php');

        require_once('close.php');
    }
    else{
        $_SESSION['erreur']="le formulaire est incomplet";
    };
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter le produit</title>
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
                <h1>Ajouter le produit</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="produit">produit</label>
                        <input type="text" id="produit" name="produit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prix">prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre">nombre</label>
                        <input type="number" id="nombre" name="nombre" class="form-control">
                    </div>
                    <button class="btn btn-primary">Envoyez</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>