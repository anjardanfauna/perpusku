<?php
include "../../assets/conn/koneksi.php";

$id_rak = $_GET['id_rak'];
$query = mysqli_query($conn, "DELETE FROM rak WHERE id='$id_rak'");
header("location:../index.php?page=3");
