<?php
include "../../assets/conn/koneksi.php";

$id = $_POST['id_pinjam'];
$tanggal = date('Y-m-d');
$status = 'pinjam';
$petugas = $_SESSION['id'];
$query = mysqli_query($conn, "UPDATE peminjaman set tanggal_pinjam='$tanggal',status_peminjaman='$status',id_petugas='$petugas' WHERE id='$id'");
header("location:../index.php?page=1");
