<?php
include "../../assets/conn/koneksi.php";

$judul = $_POST['judul'];
$id_kategori = $_POST['kategori'];
$id_rak = $_POST['rak'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$foto = $_POST['foto'];
$tahun = $_POST['tahun'];

$limit = 10 * 1024 * 1024;
$ekstensi = array('png', 'jpg', 'jpeg', 'gif');

foreach ($_FILES['foto']['name'] as $x => $namafile) {
    $tmp = $_FILES['foto']['tmp_name'][$x];
    $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
    $ukuran = $_FILES['foto']['size'][$x];

    if ($ukuran > $limit) {
        echo "gagal ukuran";
    } else {
        if (!in_array($tipe_file, $ekstensi)) {
            echo "gagal ekstensi";
        } else {
            $tanggal = date('d-m-Y');
            $file_destination = '../../assets/foto/' . $tanggal . '-' . $namafile;

            if (move_uploaded_file($tmp, $file_destination)) {
                $query = "INSERT INTO buku (id, judul, id_kategori, id_rak, penulis, penerbit, tahun, foto) 
                          VALUES ('', '$judul', '$id_kategori', '$id_rak', '$penulis', '$penerbit', '$tahun', '$tanggal-$namafile')";

                $result = mysqli_query($conn, $query);

                header("location:../index.php?page=4");
            } else {
                echo "gagal upload";
            }
        }
    }
}
