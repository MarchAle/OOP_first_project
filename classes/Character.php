<?php

class Character 
{
    // Attributs
    public $name;
    private $lifePoints = 300;
    

    // Méthodes
    public function __construct($name){
        $this->name = $name;
    }

    // Getter : récupérer un attribut
    public function getLifePoints() {
        return $this->lifePoints;
    }

    public function getMagicPoints() {
        return $this->magicPoint;
    }

    // Setter : modifie un attribut
    public function setLifePoints($damage) {
        $this->lifePoints -= $damage;
        if($this->lifePoints < 0){
            $this->lifePoints = 0;
        }
        return;
    }

    public function setMagicPoints($magicPointUsed) {
        $this->magicPoint -= $magicPointUsed;
        return;
    }

    public function isAlive() {
        if($this->lifePoints > 0){
            return true;
        }
        else {
            return false;
        }
    }
}