<?php
include "../../assets/conn/koneksi.php";
$id_anggota     = $_POST['id_anggota'];
$nama_anggota   = $_POST['nama_anggota'];
$alamat         = $_POST['alamat'];
$username       = $_POST['username'];
$password       = $_POST['password'];
$email         = $_POST['email'];

$query = mysqli_query($conn, "UPDATE pengguna SET nama_pengguna='$nama_anggota',alamat='$alamat',username='$username',password ='$password',email='$email' WHERE id='$id_anggota'");
header("location:../index.php?page=6");
