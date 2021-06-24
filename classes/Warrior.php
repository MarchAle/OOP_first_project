<?php

class Warrior extends Character
{
    public $attackPoint = 15;
    protected $magicPoint = 5;
    
    public function attack($target){
        $hit = $this->attackPoint - rand(-3, 3);

        if($target->getShieldInfos()[1] == false){
            $target->setLifePoints($hit);
            
            $attacks = ["\"Prend ça dans ta face !\"", "\"En garde, espèce de vieille pute dégarnie !\"", "\"Montjoie Saint-Denis !\"", "\"Et bim !\"", "\"Whayaaaa !\"", "\"Viens ici que j'te butte enculé !\""];
            
            $status = $attacks[rand(0, 5)]."<br>".$this->name." inflige ".$hit."pts de dégât à ".$target->name." (reste : ". $target->getLifePoints().")";
        }
        
        else if($target->getShieldInfos()[1] == true){
            if($target->getShieldInfos()[0] > $hit){
                $target->setShieldInfos($hit);
                $status = $this->name." attaque, mais le bouclier de ".$target->name." encaisse tout !";
            }
            else {
                $hit -= $target->getShieldInfos()[0];
                $target->setShieldInfos($target->getShieldInfos()[0]);
                $target->setLifePoints($hit);
                
                $status = $this->name." attaque et fait voler le bouclier de ".$target->name." en éclats ! <br>".$target->name." reçoit ".$hit."pts de dégât ! (reste : ". $target->getLifePoints().")";
            }
            $target->setShieldInfos(false);
        }

        if($target->getLifePoints() <= 0){
            $status = $status."<br><br> Fin du game : ".$target->name." gît ici pour l'éternel";
        }

        return $status;
    }
}