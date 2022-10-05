<?php
require 'connect.php';
$pdo = new PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  

    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));         
        
        if (empty($_POST['lastname'])){ 
            $erreurs[]= 'Le champ lastname doit être correctement complété!';  
        }              
        if (empty($_POST['firstname'])) {      
            $erreurs[]= 'Le champ firstname doit être correctement complété!'; 
        }


        if (empty($erreurs)) {
            $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $requete = $statement->execute();
        if($requete)
        {        
            $potes = $statement->fetchAll();
            var_dump($erreurs, $_POST);        
            header('location:index.php'); 
        }
        }
       
}  
      
            
        


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des amis</title>
</head>

<body>

    <h1>Ma liste d'amis</h1>

    <ul>
        <?php
        foreach ($friends as $friend) {
            echo '<li>' . $friend['firstname'] . ' ' . $friend['lastname'] . '</li>';
        }
        ?>
    </ul>
        <?php          

            if(count($erreurs) > 0){
                foreach ($erreurs as $erreur){
                    echo $erreur . '<br>';
                }
            };
           
        ?>
    <form action="index.php" method="post">
        <label for="firstname">Prénom</label><br>          
        <input type="text" name="firstname"><br>
       
        <label for="lastname">Nom</label><br>           
        <input  type="text" name="lastname"><br>
       
        <button type="submit" name="btn_sub">Envoyer</button>
    </form>

</body>

</html>