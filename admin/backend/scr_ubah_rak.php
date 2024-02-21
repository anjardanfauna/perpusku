<?php
include "../../assets/conn/koneksi.php";

$id_rak = $_POST['id_rak'];
$nama_rak = $_POST['nama_rak'];

$query = mysqli_query($conn, "UPDATE rak SET nama_rak ='$nama_rak' WHERE id='$id_rak'");
header("location:../index.php?page=3");
