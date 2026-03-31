<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/Register.php';

class RegisterTest extends TestCase
{
    public function testValidInput()
    {
        $reg = new Register(null);
        $this->assertTrue($reg->validate("test@mail.com", "Budi", 20));
    }

    public function testEmailKosong()
    {
        $reg = new Register(null);
        $this->assertFalse($reg->validate("", "Budi", 20));
    }

    public function testEmailTidakValid()
    {
        $reg = new Register(null);
        $this->assertFalse($reg->validate("salah", "Budi", 20));
    }

    public function testUmurBukanAngka()
    {
        $reg = new Register(null);
        $this->assertFalse($reg->validate("test@mail.com", "Budi", "dua puluh"));
    }

    public function testNamaKosong()
    {
        $reg = new Register(null);
        $this->assertFalse($reg->validate("test@mail.com", "", 20));
    }
}