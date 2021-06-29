<?php

class Bomber extends Character
{
    private $bombPower = 35;
    public $avatar = "troll.png";

    public function __construct($id, $name){
        parent::__construct($id, $name);
        $this->lifePoints *= 3;
        $this->maxLifePoints *= 3;
        $this->rapidity = 2;
    }

    public function attack($target, $warField){
        $damage = $this->bombPower + rand(-10, 10);
        $warField->setBomb($damage);
        $status = $this->name." dépose une bombe d'une puissance de ".$damage."<br>";
        return "<div class=\"char$this->id\">$status</div>";
    }

    public function isAttacked($damage, $attacker){
        $this->setLifePoints($damage);
        $this->damageTaken += $damage;
        $status = $attacker->name." inflige ".$damage."pts de dégât à ".$this->name." (reste: ".$this->getLifePoints().")";
        return $status;
    }
}