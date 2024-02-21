<?php
include "../../assets/conn/koneksi.php";
session_start();
date_default_timezone_set('Asia/Jakarta');
$id_anggota = $_SESSION['id'];
$id_buku = $_POST['id_buku'];
$ulasan = $_POST['ulasan'];
$rating = $_POST['rating'];
$waktu = date("Y-m-d H:i:s");


$query = mysqli_query($conn, "INSERT INTO ulasan_buku VALUES ('','$id_anggota','$id_buku','$ulasan','$rating','$waktu')");
header("location:../index.php?page=5");
