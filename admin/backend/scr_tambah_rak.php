<?php
include "../../assets/conn/koneksi.php";

$nama_rak = $_POST['nama_rak'];

$query = mysqli_query($conn, "INSERT INTO rak VALUES ('','$nama_rak')");
header("location:../index.php?page=3");
