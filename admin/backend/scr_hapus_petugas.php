<?php
include "../../assets/conn/koneksi.php";

$id = $_GET['id_petugas'];
$query = mysqli_query($conn, "DELETE FROM petugas WHERE id='$id'");
header("location:../index.php?page=5");
