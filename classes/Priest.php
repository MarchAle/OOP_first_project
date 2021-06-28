<?php

class Priest extends Character
{
    public $avatar = "pope.png";
    public $damageTaken = 0;

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
                return "<div class=\"char$this->id\">$status</div>";
            }
        }
        // Après avoir explosé, le nb de bombe retourne à 0
        $warField->initBomb();

        if($this->lifePoints != ($this->damageTaken + $this->lifePoints)){
            $rand = rand(1, 100);
            if($rand == 1){
                $this->lifePoints += $this->damageTaken;
                $this->damageTaken = 0;
                $status = "$this->name se soigne complètement";
            }
            if($rand >= 30){
                $targetAction = $target->isAttacked($this->attackPoint, $this);
                $status = "$this->name attaque $target->name<br>$targetAction";
            }
            else {
                $this->lifePoints += 25;
                if($this->lifePoints > ($this->damageTaken + $this->lifePoints)){
                    $this->lifePoints += $this->damageTaken;
                    $this->damageTaken = 0;
                }
                $status = "$this->name se soigne (+25pts)";
            }
        }
        else {
            $targetAction = $target->isAttacked($this->attackPoint, $this);
            $status = "$this->name attaque $target->name<br>$targetAction";
        }

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