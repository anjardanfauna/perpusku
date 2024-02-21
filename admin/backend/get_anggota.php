<?php
include "../../assets/conn/koneksi.php";
$karyawan = mysqli_fetch_array(mysqli_query($conn, "select * from pengguna where id='$_GET[id]'"));
$data_karyawan = array(
    'alamat'       =>  $karyawan['alamat'],
    'email'       =>  $karyawan['email'],
);
echo json_encode($data_karyawan);
