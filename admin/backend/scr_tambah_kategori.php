<?php
include "../../assets/conn/koneksi.php";

$nama_kategori = $_POST['nama_kategori'];

$query = mysqli_query($conn, "INSERT INTO kategori VALUES ('','$nama_kategori')");
header("location:../index.php?page=2");
