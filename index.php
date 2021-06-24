<?php

// Permet d'include les classes qui sont appellées
spl_autoload_register(function($className){
    require './classes/'.$className.'.php';
});

 $character1 = new Warrior("Exterminator");
 $character2 = new Mage("White_Wizzard");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Document</title>
</head>
<body>
    <h1>Le grand combat !</h1>
    
    <?php 
    while($character1->isAlive() && $character2->isAlive()){ 
        $random = rand(1, 2);
        if($random == 1){
            echo "<p class=\"char1\">".$character1->attack($character2)."</p>";
            $lastSentence = "Victoire de ".$character1->name;
        }
        else {
            echo "<p class=\"char2\">".$character2->attack($character1)."</p>";
            $lastSentence = "Victoire de ".$character2->name;
        }
    } 
    echo $lastSentence 
    ?>

</body>
</html>

 
