 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Pengembalian</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Pengembalian</li>
                     </ol>
                 </nav>
             </div>
         </div>

     </div>
 </div>

 <div class="container-fluid">
     <div class="row">
         <div class="col-12">
             <div class="page-header mb-3">
                 <div class="d-flex align-items-center">
                     <a href="index.php?page=10" class="btn btn-primary btn-round ml-auto">
                         <i class="fas fa-ellipsis-v"></i>
                         Lihat Detail
                     </a>
                 </div>
             </div>
             <div class="card">

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="example" class="display table table-striped table-bordered table-hover">
                             <thead>
                                 <th width=20px>No</th>
                                 <th>Nama Anggota</th>
                                 <th>Nama Petugas</th>
                                 <th>Judul</th>
                                 <th>Tanggal Pinjam</th>
                                 <th width=100px>Aksi</th>
                             </thead>
                             <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT peminjaman.id,pengguna.id as id_pengguna, pengguna.nama_pengguna,pengguna.alamat,pengguna.email,petugas.nama_petugas, buku.id as id_buku,buku.foto, buku.judul, peminjaman.tanggal_pinjam, peminjaman.status_peminjaman 
                                FROM peminjaman 
                                INNER JOIN pengguna ON peminjaman.id_pengguna = pengguna.id 
                                INNER JOIN petugas ON peminjaman.id_petugas = petugas.id 
                                INNER JOIN buku ON peminjaman.id_buku = buku.id 
                                WHERE peminjaman.status_peminjaman = 'pinjam'");

                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                 <tr>
                                     <td><?php echo $no++ ?></td>
                                     <td><?php echo $d['nama_pengguna']; ?></td>
                                     <td><?php echo $d['nama_petugas']; ?></td>
                                     <td><?php echo $d['judul']; ?></td>
                                     <td><?php echo $d['tanggal_pinjam']; ?></td>
                                     <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning btn-block m-1"><i class="far fa-edit text-white"></i></a>

                                     </td>
                                 </tr>
                                 <!-- Modal Ubah Peminjaman -->
                                 <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                     <div class="modal-dialog modal-lg" role="document">
                                         <div class="modal-content">
                                             <div class="card-header">
                                                 <div class="d-flex align-items-center">
                                                     <h4 class="card-title">Konfirmasi Pengembalian</h4>
                                                 </div>
                                             </div>
                                             <form action="backend/scr_konfirmasi_pengembalian.php" id="resetPeminjaman" method="post">
                                                 <div class="modal-body">
                                                     <!-- Grid System untuk dua kolom -->
                                                     <div class="row">
                                                         <div class="col-lg-6">
                                                             <input type="hidden" name="id_pinjam" value="<?php echo $d['id']; ?>">
                                                             <!-- Isi formulir di kolom pertama -->

                                                             <div class="form-group">
                                                                 <label for="nama anggota">Nama Anggota</label>
                                                                 <?php
                                                                    include "../assets/conn/koneksi.php";
                                                                    $id = $d['id_pengguna'];
                                                                    $anggota = mysqli_query($conn, "SELECT * FROM pengguna where id='$id'");
                                                                    while ($a = mysqli_fetch_assoc($anggota)) {
                                                                        echo '<input type="text" name="id_anggota" class="form-control" value="' . $d['nama_pengguna'] . '" readonly>';
                                                                    }
                                                                    ?>

                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="alamat">Alamat</label>
                                                                 <input type="text" class="form-control" id="alamat2" value="<?php echo $d['alamat']; ?>" readonly>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="email">Email</label>
                                                                 <input type="text" class="form-control" id="email2" value="<?php echo $d['email']; ?>" readonly>
                                                             </div>
                                                             <?php
                                                                include '../assets/conn/koneksi.php';
                                                                $buku = mysqli_query($conn, "SELECT * FROM buku");
                                                                ?>
                                                             <div class="form-group">
                                                                 <label for="judul">Judul</label>
                                                                 <select name="id_buku" onclick="cek_buku2()" id="id_foto2" class=" form-control">
                                                                     <option value="<?php echo $d['id_buku']; ?>" class="form-control"><?php echo $d['judul']; ?></option>
                                                                     <?php while ($b = mysqli_fetch_assoc($buku)) {
                                                                        ?>
                                                                         <option value="<?php echo $b['id']; ?>"><?php echo $b['judul']; ?></option>
                                                                     <?php } ?>
                                                                 </select>
                                                             </div>

                                                         </div>
                                                         <div class="col-lg-6">
                                                             <div class="form-group">
                                                                 <label for="denda">Denda</label>
                                                                 <?php
                                                                    // Mendapatkan tanggal hari ini
                                                                    $tgl_kembali = date('Y-m-d');

                                                                    // Mendapatkan tanggal pinjam dari data yang ada
                                                                    $tgl_pinjam = $d['tanggal_pinjam'];

                                                                    // Memuat file koneksi
                                                                    include "../assets/conn/koneksi.php";

                                                                    // Query untuk mendapatkan nilai denda
                                                                    $denda_query = mysqli_query($conn, "SELECT * FROM pengaturan");
                                                                    $denda_row = mysqli_fetch_assoc($denda_query);

                                                                    // Memperoleh nilai denda dan lama peminjaman dari hasil query
                                                                    $denda_per_hari = $denda_row['denda'];
                                                                    $lama_peminjaman = $denda_row['lama_pinjam'];

                                                                    // Menghitung selisih hari dan dikurangi lama pinjam hari
                                                                    $selisih_hari = (strtotime($tgl_kembali) - strtotime($tgl_pinjam)) / (60 * 60 * 24) - $lama_peminjaman;

                                                                    // Menghitung denda
                                                                    if ($selisih_hari > 0) {
                                                                        $total_denda = $selisih_hari * $denda_per_hari;
                                                                    } else {
                                                                        $total_denda = 0;
                                                                    }

                                                                    // Menampilkan input denda
                                                                    echo '<input type="text" name="denda" class="form-control" value="' . $total_denda . '" readonly>';
                                                                    ?>
                                                             </div>
                                                             <!-- Isi formulir di kolom kedua -->
                                                             <div class="form-group">
                                                                 <label for="foto">Keterangan</label>
                                                                 <?php
                                                                    // Mendapatkan tanggal hari ini
                                                                    $tgl_kembali = date('Y-m-d');

                                                                    // Mendapatkan tanggal pinjam dari data yang ada
                                                                    $tgl_pinjam = $d['tanggal_pinjam'];

                                                                    // Memuat file koneksi
                                                                    include "../assets/conn/koneksi.php";

                                                                    // Query untuk mendapatkan nilai lama pinjam
                                                                    $lama_pinjam_query = mysqli_query($conn, "SELECT * FROM pengaturan");
                                                                    $lama_pinjam_row = mysqli_fetch_assoc($lama_pinjam_query);

                                                                    // Memperoleh nilai lama pinjam dari hasil query
                                                                    $lama_pinjam = $lama_pinjam_row['lama_pinjam'];

                                                                    // Menghitung selisih hari
                                                                    $selisih_hari = abs(strtotime($tgl_kembali) - strtotime($tgl_pinjam)) / (60 * 60 * 24);

                                                                    if ($selisih_hari > $lama_pinjam) {
                                                                        echo '<input type="text" class="form-control" name="status" value="Terlambat" readonly>';
                                                                    } else {
                                                                        echo '<input type="text" class="form-control" name="status" value="Terima kasih" readonly>';
                                                                    }
                                                                    ?>


                                                             </div>
                                                             <div class="form-group">

                                                                 <?php
                                                                    if (!empty($d['foto'])) {
                                                                        echo '<img src="../assets/foto/' . $d['foto'] . '" id="foto2" width="150">';
                                                                    } else {
                                                                        echo '<img src="../assets/images/gambar.png" alt="" srcset="">';
                                                                    }
                                                                    ?>


                                                             </div>



                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                                                             <i class="fa fa-undo-alt"></i> Batal</button>
                                                     <button type="submit" class="btn btn-success"><span class="btn-label">
                                                             <i class="fa fa-save"></i> Diterima</span></button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- Akhir Modal Ubah Peminjaman -->
                             <?php } ?>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>