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
        die();
    }

     // on ecrit la requete (sql)
     $sql='DELETE FROM `liste` WHERE `id`=:id';
 
     // on prepare la requete.
     $query=$db->prepare($sql);
 
     // On accroche les params (id)
     $query->bindValue(':id',$id,PDO::PARAM_INT);
     
     // on execute la requete.
     $query->execute();
     $_SESSION['message']="Produit supprimé";
     header('Location: index.php');
 

}else{
    $_SESSION['erreur']= 'URL invalide';
    header('Location: index.php');
}
?>
