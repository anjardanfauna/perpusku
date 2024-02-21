<?php
include "../../assets/conn/koneksi.php";
session_start();
date_default_timezone_set('Asia/Jakarta');
$id_pinjam = $_POST['id_pinjam'];
$id_petugas = $_SESSION['id'];
$tgl_kembali = date('Y-m-d');
$denda = $_POST['denda'];

$update = mysqli_query($conn, "UPDATE peminjaman SET status_peminjaman='kembali' WHERE id='$id_pinjam'");
if ($update) {
    $query = mysqli_query($conn, "INSERT INTO pengembalian VALUES ('','$id_pinjam','$id_petugas','$tgl_kembali','$denda')");
    header("location:../index.php?page=8");
}
