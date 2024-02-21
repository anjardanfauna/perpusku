<?php
session_start();
include "../../assets/conn/koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$id_anggota = $_POST['id_anggota'];
$id_petugas = $_SESSION['id'];
$id_buku = $_POST['id_buku'];
$tanggal_pinjam = date('Y-m-d');
$status = 'pinjam';

$query = mysqli_query($conn, "INSERT INTO peminjaman VALUES('','$id_anggota','$id_petugas','$id_buku','$tanggal_pinjam','$status')");
header("location:../index.php?page=7");
