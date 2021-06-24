<?php

class Mage extends Character
{
    public $attackPoint = 3;
    protected $magicPoint = 100;
    protected $shield = [50, false];

    public function attack($target){
        if($this->shield[0] == 0 || $this->shield[1] == true || rand(1,10) <= 7){
            if($this->getMagicPoints() > 0){
                $fireBallPower = rand(1, 20);
                if($this->getMagicPoints() > $fireBallPower){
                    $hit = floor($fireBallPower * rand(10, 30)/10);
                    $this->setMagicPoints($fireBallPower);
                } 
                else{
                    $hit = floor($this->getMagicPoints() * rand(10, 30)/10);
                    $this->magicPoint = 0;
                }
                $attacks = ["\"Les flammes de l'enfer vont te réduire en cendres !\"","\"Brûle ! Pourriture communiste !\"","\"Pas trop cuite la merguez ?\""];
            }
            else{
                $hit = $this->attackPoint;
                $attacks = ["\"Tu vas goûter à mon bâton\"","\"Tiens, méchant ! toc\""];
            }
    
            $target->setLifePoints($hit);
            
            
            if($target->getLifePoints() <= 0){
                $status = $attacks[rand(0, count($attacks)-1)]."<br>".$this->name." inflige ".$hit."pts de dégât à ".$target->name." (reste : ". $target->getLifePoints().")<br><br> Fin du game : ".$target->name." gît ici pour l'éternel";
            }
            else {
                $status = $attacks[rand(0, count($attacks)-1)]."<br>".$this->name." inflige ".$hit."pts de dégât à ".$target->name." (reste : ". $target->getLifePoints().")<br><br>";
            }

        }
        else {
            $this->shield[1] = true;
            $status = $this->name." invoque son bouclier magique ! (Protection restante : ".$this->shield[0]." )";
        }

        return $status;
    }

    
    public function getShieldInfos(){
        return $this->shield;
    }

    public function setShieldInfos($data){
        if(gettype($data) == "integer"){
            $this->shield[0] -= $data;
            return;
        }
        else if(gettype($data) == "boolean"){
            $this->shield[1] = $data;
            return;
        }
    }
}