<?php

abstract class Character 
{
    // Attributs
    public $id;
    public $name;
    public $lifePoints = 100;
    public $attackPoint = 12;
    public $rapidity = 10;
    

    // Méthodes
    public function __construct($id, $name){
        $this->id = $id;
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