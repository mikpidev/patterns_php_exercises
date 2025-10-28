<?php
// Exercise 2 - Adapter Pattern
// File: exercise2_adapter.php
// Usage: php exercise2_adapter.php

// Legacy Windows 7 document interfaces (simulated)
interface LegacyDocument {
    public function openLegacy(): string; // returns text/content
}

class Word97 implements LegacyDocument {
    public function openLegacy(): string {
        return "Contenido de Word 97 (formato legacy)";
    }
}

class Excel97 implements LegacyDocument {
    public function openLegacy(): string {
        return "Contenido de Excel 97 (formato legacy)";
    }
}

// Modern Windows 10 expects this interface
interface ModernDocument {
    public function open(): string;
}

// Adapter that allows Windows10 apps to open legacy docs
class LegacyToModernAdapter implements ModernDocument {
    private $legacyDoc;
    public function __construct(LegacyDocument $legacyDoc) {
        $this->legacyDoc = $legacyDoc;
    }
    public function open(): string {
        // Here we could translate/massage content, change encoding, etc.
        $content = $this->legacyDoc->openLegacy();
        return "[Adapted] " . $content;
    }
}

// Consumer: Windows 10 app that opens ModernDocument
class Windows10App {
    public function loadDocument(ModernDocument $doc) {
        echo "Windows10 opening: " . $doc->open() . PHP_EOL;
    }
}

// Demo
$winApp = new Windows10App();

$legacyWord = new Word97();
$adapterWord = new LegacyToModernAdapter($legacyWord);
$winApp->loadDocument($adapterWord);

$legacyExcel = new Excel97();
$adapterExcel = new LegacyToModernAdapter($legacyExcel);
$winApp->loadDocument($adapterExcel);
