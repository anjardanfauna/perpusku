<?php
session_start();
include "../../assets/conn/koneksi.php";

$id_pinjam = $_POST['id_pinjam'];
$id_petugas = $_SESSION['id'];
$id_buku = $_POST['id_buku'];
$id_anggota = $_POST['id_anggota'];

$query = mysqli_query($conn, "UPDATE peminjaman SET id_pengguna='$id_anggota',id_buku='$id_buku',id_petugas='$id_petugas' WHERE id='$id_pinjam'");
header("location:../index.php?page=7");
