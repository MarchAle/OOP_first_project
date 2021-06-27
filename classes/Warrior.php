<?php

class Warrior extends Character
{
    protected $magicPoint = 5;

    public function __construct($id, $name){
        parent::__construct($id, $name);
        $this->lifePoints *= 2;
    }
    
    public function attack($target, $warField){
        // Vérifie si il y a des bombes sur le terrain
        $bombs = $warField->getBomb();
        $status = "";
        // Pour chaque bombe présente, on prend des dégâts
        foreach ($bombs as $bomb){
            $this->setLifePoints($bomb);
            $status = $status.$this->name." marche sur une bombe et prend ".$bomb."pts de dégâts. (reste: ".$this->getLifePoints().")<br>";
            // Si les points de vie arrivent à 0, on retourne $status et on n'attaque pas
            if($this->getLifePoints() == 0){
                $status = $status.$this->name." a succombé à ses blessures.";
                $warField->initBomb();
                return "<p class=\"char$this->id\">$status";
            }
        }
        // Après avoir explosé, le nb de bombe retourne à 0
        $warField->initBomb();

        // COUP CRITIQUE
        if(rand(0, 100) == 100){
            $target->setLifePoints(9999);
            $status = "COUP CRITIQUE ! (-9999pts)<br>$this->name extermine $target->name";
            return "<p class=\"char$this->id criticalHit\">$status";
        }
        $hit = $this->attackPoint - rand(-3, 3);
        $targetAction = $target->isAttacked($hit, $this);

        $attacks = ["\"Prend ça dans ta face !\"", "\"En garde, espèce de vieille pute dégarnie !\"", "\"Montjoie Saint-Denis !\"", "\"Et bim !\"", "\"Whayaaaa !\"", "\"Viens ici que j'te butte enculé !\""];

        $status = $status.$attacks[rand(0, 5)]."<br>".$targetAction."<br>";

        if($target->getLifePoints() == 0){
            $status = $status."<br><br>Que son âme aille en paix : ".$target->name." gît ici pour l'éternel";
        }

        return "<p class=\"char$this->id\">$status";
    }

    public function isAttacked($damage, $attacker){
        $this->setLifePoints($damage);
        $status = $attacker->name." inflige ".$damage."pts de dégât à ".$this->name." (reste: ".$this->getLifePoints().")";
        return $status;
    }
}