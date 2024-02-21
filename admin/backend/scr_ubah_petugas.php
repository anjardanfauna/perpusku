<?php
include "../../assets/conn/koneksi.php";
$id_petugas     = $_POST['id_petugas'];
$nama_petugas   = $_POST['nama_petugas'];
$alamat         = $_POST['alamat'];
$username       = $_POST['username'];
$password       = $_POST['password'];
$level          = $_POST['level'];

$query = mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama_petugas',alamat='$alamat',username='$username',password ='$password',level='$level' WHERE id='$id_petugas'");
header("location:../index.php?page=5");
