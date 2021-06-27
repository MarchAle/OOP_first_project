<?php

class Bomber extends Character
{
    private $bombPower = 35;

    public function __construct($id, $name){
        parent::__construct($id, $name);
        $this->lifePoints *= 3;
        $this->rapidity = 2;
    }

    public function attack($target, $warField){
        $this->bombPower += rand(-10, 10);
        $warField->setBomb($this->bombPower);
        $status = $this->name." dépose une bombe d'une puissance de ".$this->bombPower."<br>";
        return "<p class=\"char$this->id\">$status";
    }

    public function isAttacked($damage, $attacker){
        $this->setLifePoints($damage);
        $status = $attacker->name." inflige ".$damage."pts de dégât à ".$this->name." (reste: ".$this->getLifePoints().")";
        return $status;
    }
}