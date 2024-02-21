<?php
include "../../assets/conn/koneksi.php";
session_start();
date_default_timezone_set('Asia/Jakarta');
$id = $_GET['id_pinjam'];
$tanggal = date('Y-m-d');
$status = 'pinjam';
$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "UPDATE peminjaman set tanggal_pinjam='$tanggal',status_peminjaman='$status',id_petugas='$petugas' WHERE id='$id'");
header("location:../index.php?page=1");
