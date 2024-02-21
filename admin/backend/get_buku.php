<?php
include "../../assets/conn/koneksi.php";
$karyawan = mysqli_fetch_array(mysqli_query($conn, "select * from buku where id='$_GET[id]'"));
$data_karyawan = array(
    'foto'       =>  $karyawan['foto'],
);
echo json_encode($data_karyawan);
