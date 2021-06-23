# Fighters

## Principe
Mettre en place un combat entre deux personnages.
Ce combat sera représenté uniquement par des lignes de texte.

## Exo
### Exo 1 : initialisation des personnages
Créer une classe `Character`, dans lequel les personnages auront les attributs suivants :
- un nom : `name`
- des points de vie : `lifePoints` (100)
- un score d'attaque : `attackPoint` (15)
- (des points de magie : `magicPoints`)

Et une méthode :
- une action d'attaque : `attack()`

### Exo 2 : base du combat
Dans l'index.php, mettre en place une logique pour que le combat se déroule jusqu'a ce que l'un des deux personnages soit KO

### Exo 3 : les points de vie
Faire en sorte que les points de vie ne passent pas en dessous de 0

### Exo 4 : les sous-classes de personnages
Ajouter un système de sous-classes, avec un `Warrior` et un `Mage`
> Important pour la suite : chaque sous-classe doit être indépendante et s'autogérer.

### Exo 5 : améliorer le système d'appel des classes
Trouver une solution plus performante pour inclure les classes dont on a besoin

### Exo 6 : caractéristiques du Mage
- Le Mage a des points de magie (magicPoint) : 100
- Le Mage a une attaque de 5
- Son attaque : Boule de feu
    - Utilise aléatoirement entre 1 et 20 pts de magie
    - Les dégâts de cette attaque = magicPoint utilisé * (1 à 3 random)
- 3 possibilité d'attaque
    - Il a assez de point de magie : Boule de feu
    - S'il n'a plus assez de points de magie : Boule de feu lancée avec les pts magie qu'il lui reste
    - Si plus aucun pts magie : Attaque au bâton

Bouclier magique qui fait que les prochain dégâts soient pris par le bouclier