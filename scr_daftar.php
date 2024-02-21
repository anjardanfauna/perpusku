<?php
include "assets/conn/koneksi.php";

$nama    = $_POST['nama_pengguna'];
$alamat  = $_POST['alamat'];
$email   = $_POST['email'];
$user    = $_POST['username'];
$pass    = $_POST['password'];

// Periksa apakah nama pengguna sudah ada di tabel pengguna
$query_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$user'");
if (mysqli_num_rows($query_pengguna) > 0) {
    // Jika ada, berikan pesan kesalahan
    echo '<script>
                    alert("Nama pengguna sudah dipakai. Silakan pilih nama pengguna yang lain.");
                    window.location.href = "daftar.php";
              </script>';
} else {
    // Jika tidak, periksa apakah nama pengguna sudah ada di tabel petugas
    $query_petugas = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$user'");
    if (mysqli_num_rows($query_petugas) > 0) {
        // Jika ada, berikan pesan kesalahan
        echo '<script>
                    alert("Nama pengguna sudah dipakai. Silakan pilih nama pengguna yang lain.");
                    window.location.href = "daftar.php";
              </script>';
    } else {
        // Jika tidak ada, data dapat dimasukkan ke dalam tabel pengguna
        $query_insert = mysqli_query($conn, "INSERT INTO pengguna VALUES('', '$nama', '$alamat', '$email', '$user', '$pass')");
        if ($query_insert) {
            header("location:login.php");
        } else {
            echo '<script>
                    alert("Terjadi kesalahan saat menyimpan data.Silahkan coba lagi.");
                    window.location.href = "daftar.php";
              </script>';
        }
    }
}
