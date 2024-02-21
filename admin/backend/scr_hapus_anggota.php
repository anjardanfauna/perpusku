<?php
include "../../assets/conn/koneksi.php";

$id = $_GET['id_anggota'];
$query = mysqli_query($conn, "DELETE FROM pengguna WHERE id='$id'");
header("location:../index.php?page=6");
