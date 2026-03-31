<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/Register.php';

class RegisterIntegrationTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = mysqli_connect("localhost", "root", "", "akademik_test");
        mysqli_query($this->conn, "CREATE TABLE IF NOT EXISTS mahasiswa (
            email VARCHAR(100),
            nama VARCHAR(100),
            umur INT
        )");
    }

    public function testInsertData()
    {
        $reg = new Register($this->conn);

        $result = $reg->save("test@mail.com", "Budi", 20);

        $this->assertTrue($result);
    }

    public function testDataTersimpan()
    {
        $reg = new Register($this->conn);
        $reg->save("cek@mail.com", "Andi", 22);

        $result = mysqli_query($this->conn, "SELECT * FROM mahasiswa WHERE email='cek@mail.com'");
        $this->assertTrue(mysqli_num_rows($result) > 0);
    }
    public function save($email, $nama, $umur)
    {
    if (!$this->conn) return false;

    $stmt = mysqli_prepare(
        $this->conn,
        "INSERT INTO mahasiswa (email, nama, umur) VALUES (?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "ssi", $email, $nama, $umur);

    return mysqli_stmt_execute($stmt);
    }
}