<?php
include "../../assets/conn/koneksi.php";

$nama_petugas   = $_POST['nama_petugas'];
$alamat         = $_POST['alamat'];
$username       = $_POST['username'];
$pass           = $_POST['password'];
$level          = $_POST['level'];


$query = mysqli_query($conn, "INSERT INTO petugas VALUES ('','$nama_petugas','$alamat','$username','$pass','$level')");
header("location:../index.php?page=5");
