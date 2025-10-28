<?php
// Exercise 3 - Decorator Pattern
// File: exercise3_decorator.php
// Usage: php exercise3_decorator.php

interface Character {
    public function getDescription(): string;
    public function getAttackPower(): int;
}

class Warrior implements Character {
    public function getDescription(): string {
        return "Warrior";
    }
    public function getAttackPower(): int {
        return 10;
    }
}

class Archer implements Character {
    public function getDescription(): string {
        return "Archer";
    }
    public function getAttackPower(): int {
        return 8;
    }
}

// Base Decorator
abstract class WeaponDecorator implements Character {
    protected $character;
    public function __construct(Character $character) {
        $this->character = $character;
    }
    abstract public function getDescription(): string;
    abstract public function getAttackPower(): int;
}

// Concrete Decorators
class Sword extends WeaponDecorator {
    public function getDescription(): string {
        return $this->character->getDescription() . " + Sword";
    }
    public function getAttackPower(): int {
        return $this->character->getAttackPower() + 6;
    }
}

class Shield extends WeaponDecorator {
    public function getDescription(): string {
        return $this->character->getDescription() . " + Shield";
    }
    public function getAttackPower(): int {
        // Shield improves defense, but we will add a small attack bonus
        return $this->character->getAttackPower() + 1;
    }
}

class Bow extends WeaponDecorator {
    public function getDescription(): string {
        return $this->character->getDescription() . " + Bow";
    }
    public function getAttackPower(): int {
        return $this->character->getAttackPower() + 5;
    }
}

// Demo: stacking decorators
$warrior = new Warrior();
$warriorWithSword = new Sword($warrior);
$warriorWithSwordAndShield = new Shield($warriorWithSword);

$archer = new Archer();
$archerWithBow = new Bow($archer);
$archerWithBowAndSword = new Sword($archerWithBow);

$chars = [
    $warrior,
    $warriorWithSword,
    $warriorWithSwordAndShield,
    $archer,
    $archerWithBow,
    $archerWithBowAndSword
];

foreach ($chars as $c) {
    echo $c->getDescription() . " => Attack Power: " . $c->getAttackPower() . PHP_EOL;
}
