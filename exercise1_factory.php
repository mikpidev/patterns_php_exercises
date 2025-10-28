<?php
// Exercise 1 - Factory Pattern
// File: exercise1_factory.php
// Usage: php exercise1_factory.php

interface CharacterInterface {
    public function attack(): string;
    public function getSpeed(): int;
    public function getName(): string;
}

class Skeleton implements CharacterInterface {
    public function attack(): string {
        return "Skeleton slashes with rusty blade.";
    }
    public function getSpeed(): int {
        return 7;
    }
    public function getName(): string {
        return "Esqueleto";
    }
}

class Zombie implements CharacterInterface {
    public function attack(): string {
        return "Zombie bites ferociously.";
    }
    public function getSpeed(): int {
        return 3;
    }
    public function getName(): string {
        return "Zombi";
    }
}

class GameCharacterFactory {
    public static function create(string $level): CharacterInterface {
        $level = strtolower($level);
        if ($level === 'facil' || $level === 'easy') {
            return new Skeleton();
        } elseif ($level === 'dificil' || $level === 'hard') {
            return new Zombie();
        }
        // Default
        return new Skeleton();
    }
}

// Demo
$levels = ['easy', 'hard'];
foreach ($levels as $lvl) {
    $char = GameCharacterFactory::create($lvl);
    echo "Level: $lvl\n";
    echo "Character: " . $char->getName() . PHP_EOL;
    echo "Attack: " . $char->attack() . PHP_EOL;
    echo "Speed: " . $char->getSpeed() . PHP_EOL;
    echo str_repeat('-', 30) . PHP_EOL;
}
