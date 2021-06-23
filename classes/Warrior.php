<?php

class Warrior extends Character
{
    public $attackPoint = 15;
    protected $magicPoint = 5;
    
    public function attack($target){
        $hit = $this->attackPoint - rand(-3, 3);

        $target->setLifePoints($hit);
        
        $attacks = ["\"Prend ça dans ta face !\"", "\"En garde, espèce de vieille pute dégarnie !\"", "\"Montjoie Saint-Denis !\"", "\"Et bim !\"", "\"Whayaaaa !\"", "\"Viens ici que j'te butte enculé !\""];

        $status = $attacks[rand(0, 5)]."<br>".$this->name." inflige ".$hit."pts de dégât à ".$target->name." (reste : ". $target->getLifePoints().")<br><br>";
        
        if($target->getLifePoints() <= 0){
            $status = $attacks[rand(0, 5)]."<br>".$this->name." inflige ".$hit."pts de dégât à ".$target->name." (reste : ". $target->getLifePoints().")<br><br> Fin du game : ".$target->name." gît ici pour l'éternel";
        }
        return $status;
    }
}