<?php

declare(strict_types=1);

namespace App\Entity;

// Défini le mouton
class Mouton
{
    private $id = -1;
    private $hunger = 0;
    private $playfulness = 0;
    private $sleepiness = 0;
    private $life = 10;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getHunger() {
        return $this->hunger;
    }

    public function getPlayfulness() {
        return $this->playfulness;
    }

    public function getSleepiness() {
        return $this->sleepiness;
    }

    public function getLife() {
        return $this->life;
    }

    public function circleOfLife() {
        $this->hunger++;
        $this->sleepiness++;
        $this->playfulness++;
    
        if ($this->hunger > 7) { $this->life--; }
        if ($this->sleepiness > 7) { $this->life--; }
        if ($this->playfulness > 7) { $this->life--; }
    }

    public function goToEat() {
        $this->hunger -= 5;
        $this->sleepiness++;
    }

    public function goToDoctor() {
        $this->life += 2;
    }

    public function goToSleep() {
        $this->hunger += 4;
        $this->sleepiness -= 7;
    }

    public function goToPlay() {
        $this->hunger += 2;
        $this->sleepiness += 2;
        $this->playfulness -= 5;
    }

}
