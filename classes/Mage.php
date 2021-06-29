<?php

class Mage extends Character
{
    protected $magicPoint = 150;
    public $avatar = "wizard.png";
    private $shield = [75, false];

    public function __construct($id, $name){
        parent::__construct($id, $name);    // Permet de "copier" le construct du parent
        $this->attackPoint /= 3;            // On peut ainsi modifier l'attribut '$attackPoint' issu du parent pour l'adapter à l'enfant
    }

    public function attack($target, $warField){
        // Vérifie si il y a des bombes sur le terrain
        $bombs = $warField->getBomb();
        $status = "";
        // Pour chaque bombe présente, on prend des dégâts
        foreach ($bombs as $bomb){
            if($this->shield[1] == false){
                $this->setLifePoints($bomb);
                $status = $status.$this->name." marche sur une bombe et prend ".$bomb."pts de dégâts. (reste: ".$this->getLifePoints().")<br>";
                $this->damageTaken += $bomb;
            }
            else if($this->shield[1] == true){
                if($this->shield[0] > $bomb){
                    $this->shield[0] -= $bomb;
                    $bomb = 0;
                    $status = $status."$this->name marche sur une bombe mais son bouclier encaisse les dégâts<br>";
                }
                else{
                    $bomb -= $this->shield[0];
                    $this->shield[0] = 0;
                    $this->setLifePoints($bomb);
                    $status = $status.$this->name." marche sur une bombe qui fait exploser son bouclier<br>".$this->name." prend ".$bomb."pts de dégâts résiduels. (reste: ".$this->getLifePoints().")<br>";
                    $this->damageTaken += $bomb;
                }
                $this->shield[1] = false;
            }
            // Si les points de vie arrivent à 0, on retourne $status et on n'attaque pas
            if($this->getLifePoints() == 0){
                $status = $status.$this->name." a succombé à ses blessures.";
                $warField->initBomb();
                return "<div class=\"char$this->id\">$status</div>";
            }
        }
        // Après avoir explosé, le nb de bombe retourne à 0
        $warField->initBomb();

        if($this->shield[0] == 0 || $this->shield[1] == true || rand(1,10) <= 7){
            if($this->getMagicPoints() > 0){
                $data = $this->fireBall();
                $hit = $data[0];
                $attacks = $data[1];
            }
            else{
                $data = $this->rodAttack();
                $hit = $data[0];
                $attacks = $data[1];
            }
    
            $targetAction = $target->isAttacked($hit, $this);

            $status = $status.$attacks[rand(0, count($attacks)-1)]."<br>".$targetAction."<br>";

            if($target->getLifePoints() <= 0){
                $status = $status."<br>Que son âme aille en paix : ".$target->name." gît ici pour l'éternel";
            }
        }
        else {
            $status = $status.$this->setShieldOn();
        }
        return "<div class=\"char$this->id\">$status</div>";
    }

    public function fireBall(){
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
        return [$hit, $attacks];
    }

    public function rodAttack(){
        $hit = $this->attackPoint;
        $attacks = ["\"Tu vas goûter à mon bâton\"","\"Tiens, méchant ! toc\""];
        return [$hit, $attacks];
    }

    public function setShieldOn(){
        $this->shield[1] = true;
        $status = $this->name." invoque son bouclier magique ! (Protection restante: ".$this->shield[0].")";
        return $status;
    }

    public function isAttacked($damage, $attacker){
        if($this->shield[1] == false){
            $this->setLifePoints($damage);
            $status = $attacker->name." inflige ".$damage."pts de dégât à ".$this->name." (reste: ".$this->getLifePoints().")";
            $this->damageTaken += $damage;
        }
        else if($this->shield[1] == true){
            if($this->shield[0] > $damage){
                $this->shield[0] -= $damage;
                $damage = 0;
                $status = "Le bouclier de $this->name encaisse l'attaque de $attacker->name";
            }
            else{
                $damage -= $this->shield[0];
                $this->shield[0] = 0;
                $this->setLifePoints($damage);
                $status = "L'attaque detruit le bouclier de ".$this->name."<br>". $attacker->name." inflige ".$damage."pts de dégât à ".$this->name." (reste: ".$this->getLifePoints().")";
                $this->damageTaken += $damage;
            }
            $this->shield[1] = false;
        }
        return $status;
    }
}