<?php
include "../../assets/conn/koneksi.php";

$id_kategori = $_GET['id_kategori'];
$query = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id_kategori'");
header("location:../index.php?page=2");
