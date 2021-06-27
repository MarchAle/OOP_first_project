<?php

class WarField
{
    public $bombs = [];

    public function setBomb($bombPower){
        array_push($this->bombs, $bombPower);
        return;
    }

    public function getBomb(){
        return $this->bombs;
    }

    public function initBomb(){
        $this->bombs = [];
        return;
    }
}