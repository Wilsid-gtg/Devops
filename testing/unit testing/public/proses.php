<?php

require_once 'src/register.php';

$koneksi = mysqli_connect("localhost", "root", "", "akademik");

$register = new Register($koneksi);

$email = $_POST['email'];
$nama  = $_POST['nama'];
$umur  = $_POST['umur'];

if ($register->validate($email, $nama, $umur)) {
    if ($register->save($email, $nama, $umur)) {
        echo "Registrasi berhasil";
    } else {
        echo "Gagal simpan data";
    }
} else {
    echo "Input tidak valid";
}