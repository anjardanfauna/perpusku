<?php
include "../../assets/conn/koneksi.php";
$id = $_POST['id'];
$lama = $_POST['lama_pinjam'];
$denda = $_POST['denda'];

$query = mysqli_query($conn, "UPDATE pengaturan SET lama_pinjam='$lama', denda='$denda' WHERE id='$id'");
header("location:../index.php?page=9");
