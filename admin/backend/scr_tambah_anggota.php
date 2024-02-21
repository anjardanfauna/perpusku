<?php
include "../../assets/conn/koneksi.php";

$nama_anggota = $_POST['nama_anggota'];
$alamat         = $_POST['alamat'];
$username       = $_POST['username'];
$pass           = $_POST['password'];
$email         = $_POST['email'];


$query = mysqli_query($conn, "INSERT INTO pengguna VALUES ('','$nama_anggota','$alamat','$email','$username','$pass')");
header("location:../index.php?page=6");
