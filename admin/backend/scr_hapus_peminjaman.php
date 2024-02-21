<?php
include "../../assets/conn/koneksi.php";
$id_pinjam = $_GET['id_pinjam'];
$query = mysqli_query($conn, "Delete From peminjaman WHERE id='$id_pinjam'");
header("location:../index.php?page=7");
