<?php
session_start();
include "../../assets/conn/koneksi.php";
date_default_timezone_set('Asia/Jakarta');
// Pastikan $_GET['page'] di-set sebelum mengaksesnya
$url = $_POST['page'];
$id_anggota = $_SESSION['id'];
$id_petugas = ''; // Anda mungkin ingin menambahkan logika untuk menentukan id petugas
$id_buku = $_POST['id_buku']; // Pastikan form menggunakan metode POST dan ada input dengan nama 'id_buku'
$tanggal_pinjam = date('Y-m-d');
$status = '0';

$query = mysqli_query($conn, "INSERT INTO peminjaman VALUES('', '$id_anggota', '$id_petugas', '$id_buku', '$tanggal_pinjam', '$status')");

if ($query) {
    // Jika query berhasil dijalankan, redirect ke halaman yang sesuai
    if ($url == "2") {
        header("location:../index.php?page=2");
    } else {
        header("location:../index.php?page=4");
    }
} else {
    // Jika terjadi kesalahan saat menjalankan query, lakukan penanganan yang sesuai
    echo "Terjadi kesalahan saat memproses permintaan.";
}
