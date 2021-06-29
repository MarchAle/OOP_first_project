<?php

class Warrior extends Character
{
    protected $magicPoint = 5;
    public $avatar = "warrior.png";

    public function __construct($id, $name){
        parent::__construct($id, $name);
        $this->lifePoints *= 2;
        $this->maxLifePoints *= 2;
    }
    
    public function attack($target, $warField){
        // Vérifie si il y a des bombes sur le terrain
        $bombs = $warField->getBomb();
        $status = "";
        // Pour chaque bombe présente, on prend des dégâts
        foreach ($bombs as $bomb){
            $this->setLifePoints($bomb);
            $status = $status.$this->name." marche sur une bombe et prend ".$bomb."pts de dégâts. (reste: ".$this->getLifePoints().")<br>";
            $this->damageTaken += $bomb;
            // Si les points de vie arrivent à 0, on retourne $status et on n'attaque pas
            if($this->getLifePoints() == 0){
                $status = $status.$this->name." a succombé à ses blessures.";
                $warField->initBomb();
                return "<div class=\"char$this->id\">$status</div>";
            }
        }
        // Après avoir explosé, le nb de bombe retourne à 0
        $warField->initBomb();

        // COUP CRITIQUE
        if(rand(0, 100) == 100){
            $target->setLifePoints(9999);
            $status = $status."COUP CRITIQUE ! (-9999pts)<br>$this->name extermine $target->name";
            return "<div class=\"char$this->id criticalHit\">$status</div>";
        }
        $hit = $this->attackPoint - rand(-3, 3);
        $targetAction = $target->isAttacked($hit, $this);

        $attacks = ["\"Prend ça dans ta face !\"", "\"En garde, espèce de vieille pute dégarnie !\"", "\"Montjoie Saint-Denis !\"", "\"Et bim !\"", "\"Whayaaaa !\"", "\"Viens ici que j'te bute enculé !\""];

        $status = $status.$attacks[rand(0, 5)]."<br>".$targetAction."<br>";

        if($target->getLifePoints() == 0){
            $status = $status."<br>Que son âme aille en paix : ".$target->name." gît ici pour l'éternel";
        }

        return "<div class=\"char$this->id\">$status</div>";
    }

    public function isAttacked($damage, $attacker){
        $this->setLifePoints($damage);
        $status = $attacker->name." inflige ".$damage."pts de dégât à ".$this->name." (reste: ".$this->getLifePoints().")";
        $this->damageTaken += $damage;
        return $status;
    }
}