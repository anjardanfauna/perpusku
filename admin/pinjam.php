 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Peminjaman</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Peminjaman</li>
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
                     <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambahDataModal">
                         <i class="fa fa-plus"></i>
                         Tambah Data
                     </button>
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
                                     <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>
                                         <a href="backend/scr_hapus_peminjaman.php?id_pinjam=<?php echo $d['id']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
                                     </td>
                                 </tr>
                                 <!-- Modal Ubah Peminjaman -->
                                 <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                     <div class="modal-dialog modal-lg" role="document">
                                         <div class="modal-content">
                                             <div class="card-header">
                                                 <div class="d-flex align-items-center">
                                                     <h4 class="card-title">Ubah Peminjaman</h4>
                                                 </div>
                                             </div>
                                             <form action="backend/scr_ubah_peminjaman.php" id="resetPeminjaman" method="post">
                                                 <div class="modal-body">
                                                     <!-- Grid System untuk dua kolom -->
                                                     <div class="row">
                                                         <div class="col-lg-6">
                                                             <input type="hidden" name="id_pinjam" value="<?php echo $d['id']; ?>">
                                                             <!-- Isi formulir di kolom pertama -->

                                                             <div class="form-group">
                                                                 <label for="nama anggota">Nama Anggota</label>
                                                                 <select name="id_anggota" onclick="cek_anggota2()" id="id_anggota" class=" form-control">
                                                                     <option value="<?php echo $d['id_pengguna']; ?>"><?php echo $d['nama_pengguna']; ?></option>
                                                                     <?php
                                                                        include '../assets/conn/koneksi.php';
                                                                        $anggota = mysqli_query($conn, "SELECT * FROM pengguna");
                                                                        while ($a = mysqli_fetch_assoc($anggota)) {
                                                                            echo "<option value='$a[id]'>$a[nama_pengguna]</option>";
                                                                        } ?>
                                                                 </select>

                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="alamat">Alamat</label>
                                                                 <input type="text" class="form-control" id="alamat2" value="<?php echo $d['alamat']; ?>" readonly>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="email">Email</label>
                                                                 <input type="text" class="form-control" id="email2" value="<?php echo $d['email']; ?>" readonly>
                                                             </div>
                                                         </div>
                                                         <div class="col-lg-6">
                                                             <!-- Isi formulir di kolom kedua -->
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
                                                             <div class="form-group">

                                                                 <img src="../assets/foto/<?php echo $d['foto']; ?>" id="foto2" width="150" alt="">
                                                             </div>

                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                                                             <i class="fa fa-undo-alt"></i> Batal</button>
                                                     <button type="submit" class="btn btn-success"><span class="btn-label">
                                                             <i class="fa fa-save"></i> Simpan</span></button>
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

 <!-- Modal Tambah Peminjaman -->
 <div class=" modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="card-header">
                 <div class="d-flex align-items-center">
                     <h4 class="card-title">Data Peminjaman</h4>
                 </div>
             </div>
             <form action="backend/scr_tambah_peminjaman.php" id="resetPeminjaman" method="post">
                 <div class="modal-body">
                     <!-- Grid System untuk dua kolom -->
                     <div class="row">
                         <div class="col-lg-6">
                             <!-- Isi formulir di kolom pertama -->
                             <?php
                                include '../assets/conn/koneksi.php';
                                $data = mysqli_query($conn, "SELECT * FROM pengguna");
                                ?>
                             <div class="form-group">
                                 <label for="nama anggota">Nama Anggota</label>
                                 <select name="id_anggota" onclick="cek_anggota()" id="id_anggota2" class=" form-control">
                                     <?php while ($d = mysqli_fetch_assoc($data)) {
                                        ?>
                                         <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_pengguna']; ?></option>
                                     <?php } ?>
                                 </select>

                             </div>
                             <div class="form-group">
                                 <label for="alamat">Alamat</label>
                                 <input type="text" id="alamat" class="form-control" name="alamat" readonly>
                             </div>
                             <div class="form-group">
                                 <label for="email">Email</label>
                                 <input type="text" id="email" class="form-control" name="email" readonly>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <!-- Isi formulir di kolom kedua -->
                             <?php
                                include '../assets/conn/koneksi.php';
                                $data = mysqli_query($conn, "SELECT * FROM buku");
                                ?>
                             <div class="form-group">
                                 <label for="judul">Judul</label>
                                 <select name="id_buku" onclick="cek_buku()" id="id_foto" class=" form-control">
                                     <?php while ($d = mysqli_fetch_assoc($data)) {
                                        ?>
                                         <option value="<?php echo $d['id']; ?>"><?php echo $d['judul']; ?></option>
                                     <?php } ?>
                                 </select>
                             </div>
                             <div class="form-group">

                                 <img id="foto" width="150" alt="">
                             </div>

                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                             <i class="fa fa-undo-alt"></i> Batal</button>
                     <button type="submit" class="btn btn-success"><span class="btn-label">
                             <i class="fa fa-save"></i> Simpan</span></button>
                 </div </form>
         </div>
     </div>
 </div>
 <!-- Akhir Modal -->