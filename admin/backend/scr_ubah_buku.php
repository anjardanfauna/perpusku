<?php
include "../../assets/conn/koneksi.php";

$id         = $_POST['id'];
$judul      = $_POST['judul'];
$id_kategori    = $_POST['kategori'];
$id_rak         = $_POST['rak'];
$penulis        = $_POST['penulis'];
$penerbit       = $_POST['penerbit'];
$tahun          = $_POST['tahun'];

$limit = 10 * 1024 * 1024;
$ekstensi = array('png', 'jpg', 'jpeg', 'gif');
$jumlahFile = count($_FILES['foto']['name']);

// Default nama file
$x = $_POST['old_foto'];

// Cek apakah ada file yang diunggah
if (!empty($_FILES['foto']['name'][0])) {
    for ($i = 0; $i < $jumlahFile; $i++) {
        $namafile = $_FILES['foto']['name'][$i];
        $tmp = $_FILES['foto']['tmp_name'][$i];
        $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
        $ukuran = $_FILES['foto']['size'][$i];

        if ($ukuran > $limit) {
            echo "gagal ukuran";
        } elseif (!in_array($tipe_file, $ekstensi)) {
            echo "gagal ekstensi";
        } else {
            // Hapus gambar yang sudah ada
            unlink('../../assets/foto/' . $x);

            // Upload gambar baru
            $x = date('d-m-Y') . '-' . $namafile;
            move_uploaded_file($tmp, '../../assets/foto/' . $x);
        }
    }
}
if ($namafile == "") {
    $query = "UPDATE buku SET
            judul = '$judul',
            id_kategori ='$id_kategori',
            id_rak='$id_rak',
            penulis='$penulis',
            penerbit='$penerbit',
            tahun='$tahun'
          WHERE id = '$id'";
} else {

    // Query update
    $query = "UPDATE buku SET
            judul = '$judul',
            id_kategori ='$id_kategori',
            id_rak='$id_rak',
            penulis='$penulis',
            penerbit='$penerbit',
            tahun='$tahun',
            foto = '$x'
          WHERE id = '$id'";
}

// Eksekusi query
$result = mysqli_query($conn, $query);

if ($result) {
    // Data berhasil diupdate
    header("location:../index.php?page=4");
} else {
    // Terjadi kesalahan
    echo "Error: " . mysqli_error($conn);
}
