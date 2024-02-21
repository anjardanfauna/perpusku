<?php
include "../../assets/conn/koneksi.php";

$id_kategori = $_POST['id_kategori'];
$nama_kategori = $_POST['nama_kategori'];

$query = mysqli_query($conn, "UPDATE kategori SET nama_kategori ='$nama_kategori' WHERE id='$id_kategori'");
header("location:../index.php?page=2");
