<?php
session_start();
include "../../assets/conn/koneksi.php";

$id_anggota = $_SESSION['id'];
$id_buku = $_POST['id_buku'];


$query = mysqli_query($conn, "INSERT INTO koleksi_pribadi VALUES('','$id_anggota','$id_buku')");
header("location:../index.php?page=2");
