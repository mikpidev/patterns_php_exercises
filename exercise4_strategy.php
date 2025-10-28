<?php
// Exercise 4 - Strategy Pattern
// File: exercise4_strategy.php
// Usage: php exercise4_strategy.php

interface OutputStrategy {
    public function output(string $message): void;
}

// Concrete strategies
class ConsoleOutput implements OutputStrategy {
    public function output(string $message): void {
        echo "[CONSOLE] " . $message . PHP_EOL;
    }
}

class JsonOutput implements OutputStrategy {
    public function output(string $message): void {
        $payload = ['timestamp' => time(), 'message' => $message];
        echo json_encode($payload, JSON_PRETTY_PRINT) . PHP_EOL;
    }
}

class TxtFileOutput implements OutputStrategy {
    private $file;
    public function __construct(string $file = '/tmp/output.txt') {
        $this->file = $file;
    }
    public function output(string $message): void {
        $line = date('c') . " - " . $message . PHP_EOL;
        file_put_contents($this->file, $line, FILE_APPEND | LOCK_EX);
        echo "[TXT] Wrote to {$this->file}" . PHP_EOL;
    }
}

// Context
class MessagePrinter {
    private $strategy;
    public function __construct(OutputStrategy $strategy) {
        $this->strategy = $strategy;
    }
    public function setStrategy(OutputStrategy $strategy) {
        $this->strategy = $strategy;
    }
    public function print(string $message) {
        $this->strategy->output($message);
    }
}

// Demo
$printer = new MessagePrinter(new ConsoleOutput());
$printer->print("Hola mundo - console");

$printer->setStrategy(new JsonOutput());
$printer->print("Hola mundo - json");

$printer->setStrategy(new TxtFileOutput('/tmp/patterns_output.txt'));
$printer->print("Hola mundo - txt");
