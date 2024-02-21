<?php
include "../../assets/conn/koneksi.php";

$lama = $_POST['lama_pinjam'];
$denda = $_POST['denda'];

$query = mysqli_query($conn, "INSERT INTO pengaturan VALUES ('','$lama','$denda')");
header("location:../index.php?page=9");
