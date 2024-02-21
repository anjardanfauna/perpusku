<?php
include "../../assets/conn/koneksi.php";
$id_koleksi = $_GET['id_koleksi'];
$query = mysqli_query($conn, "Delete From koleksi_pribadi WHERE id='$id_koleksi'");
header("location:../index.php?page=4");
