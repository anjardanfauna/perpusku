<?php
include '../../assets/conn/koneksi.php';

// Menangkap data id yang dikirim dari URL
$id = $_GET['id_buku'];

// Mengambil nama file gambar sebelum data dihapus
$queryFoto = "SELECT foto FROM buku WHERE id='$id'";
$resultFoto = mysqli_query($conn, $queryFoto);
$rowFoto = mysqli_fetch_assoc($resultFoto);
$namaFoto = $rowFoto['foto'];

// Menghapus data dari database
$query = "DELETE FROM buku WHERE id='$id'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Hapus gambar terkait
    unlink('../../assets/foto/' . $namaFoto);

    // Data berhasil dihapus
    header("location:../index.php?page=4");
} else {
    // Terjadi kesalahan
    echo "Error: " . mysqli_error($conn);
}
