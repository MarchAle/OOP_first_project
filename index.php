<?php

// Permet d'include automatiquement les classes qui sont appelées
spl_autoload_register(function($className){
    require './classes/'.$className.'.php';
});

$warField = new WarField;

$character1 = new Warrior(1, "Doom_Knight");
$character2 = new Mage(2, "White_Wizzard");
$character3 = new Bomber(3, "El_Trappor");
$character4 = new Priest(4, "Wololo");

$allCharacters = [$character1, $character2, $character3, $character4];
$nbOfCharacters = count($allCharacters);

$allAttackers = [];
foreach($allCharacters as $character){
    for($i = $character->rapidity; $i > 0; $i--){
        array_push($allAttackers, $character);
    }
};
$nbOfAttackers = count($allAttackers);

function setTargetId($attackerId, $nbOfCharacters, $allAttackers, $allCharacters){
    $targetId = rand(0, $nbOfCharacters-1);
    if($allAttackers[$attackerId] == $allCharacters[$targetId]){
        return setTargetId($attackerId, $nbOfCharacters, $allAttackers, $allCharacters);
    }
    return $targetId;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/swords.png" type="image/png">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/script.js" defer></script>
    <title>RandomWar</title>
</head>
<body>
    <h1>RANDOMWAR</h1>
    <div id="btn"></div>
    
    <?php 
    while($nbOfCharacters > 1){ 
        $attackerId = rand(0, ($nbOfAttackers-1));
        $targetId = setTargetId($attackerId, $nbOfCharacters, $allAttackers, $allCharacters);
        
        echo "<div class=\"round\"><div class=\"lifeBarOuter\"><div class=\"lifeBarInner\" style=\"height:".$allAttackers[$attackerId]->getLifePoints()*50/($allAttackers[$attackerId]->damageTaken + $allAttackers[$attackerId]->lifePoints)."px\"></div></div><img class=\"avatar\" src=\"./img/".$allAttackers[$attackerId]->avatar."\" alt=\"avatar\">".$allAttackers[$attackerId]->attack($allCharacters[$targetId], $warField)."</div>";

        foreach($allCharacters as $character){
            if ($character->isAlive() == false){
                array_splice($allCharacters, array_search($character, $allCharacters), 1);
                $nbOfCharacters = count($allCharacters);
                array_splice($allAttackers, array_search($character, $allAttackers), $character->rapidity);
                $nbOfAttackers = count($allAttackers);
            }
        };
    } 
    ?>
    
<div class=\"lifeBarOuter\">
    <div class=\"lifeBarInner\" style=\"height: XXX\"></div>
</div>

    <p class="victory">
        Victoire de <?= $allCharacters[0]->name ?> !
    </p>

</body>
</html>

<img src="./img/$allAttackers[$attackerId]->img" alt="">