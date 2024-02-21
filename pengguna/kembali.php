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
             <div class="card">

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="example" class="display table table-striped table-bordered table-hover">
                             <thead>
                                 <th width=20px>No</th>
                                 <th>Judul</th>
                                 <th>Tanggal Pinjam</th>
                                 <th>Tanggal Kembali</th>
                                 <th>Denda</th>
                                 <th>Status</th>
                                 <th>Aksi</th>

                             </thead>
                             <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT pengembalian.id_peminjaman,pengembalian.tanggal_kembali,pengembalian.denda,peminjaman.id, pengguna.id as id_pengguna, buku.id as id_buku, buku.foto, buku.judul, peminjaman.tanggal_pinjam, peminjaman.status_peminjaman 
                                FROM pengembalian INNER JOIN peminjaman ON pengembalian.id_peminjaman=peminjaman.id
                                INNER JOIN pengguna ON peminjaman.id_pengguna = pengguna.id 
                                INNER JOIN buku ON peminjaman.id_buku = buku.id 
                                WHERE peminjaman.status_peminjaman = '0' or peminjaman.status_peminjaman = 'kembali'  AND id_pengguna = " . $_SESSION['id']);


                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                 <tr>
                                     <td><?php echo $no++ ?></td>
                                     <td><?php echo $d['judul']; ?></td>
                                     <td><?php echo $d['tanggal_pinjam']; ?></td>
                                     <td><?php echo $d['tanggal_kembali']; ?></td>
                                     <td><?php echo $d['denda']; ?></td>
                                     <td><?php if ($d['status_peminjaman'] == '0') {
                                                echo 'Menunggu Konfirmasi';
                                            } else {
                                                echo $d['status_peminjaman'];
                                            } ?></td>
                                     <td><button class="btn btn-warning btn-block text-white" data-toggle="modal" data-target="#tambahDataModal"><i data-feather="message-square" class="feather-icon"></i> Beri Ulasan</button></td>

                                 </tr>
                                 <!--Modal Tambah Data Kategori -->
                                 <div class=" modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                     <div class="modal-dialog modal-lg-2" role="document">
                                         <div class="modal-content">
                                             <div class="card-header">
                                                 <div class="d-flex align-items-center">
                                                     <h4 class="card-title">Beri Ulasan</h4>
                                                 </div>
                                             </div>
                                             <form action="backend/scr_tambah_ulasan.php" method="post">
                                                 <div class="modal-body">
                                                     <div class="row">
                                                         <div class="col">
                                                             <div class="form-group">
                                                                 <label for="judul">Judul</label>
                                                                 <input type="hidden" name="id_buku" value="<?php echo $d['id_buku']; ?>">
                                                                 <input class="form-control" type="text" name="judul" value="<?php echo $d['judul']; ?>" readonly>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="jenis">Ulasan</label>
                                                                 <textarea class="form-control" name="ulasan" rows="5"></textarea>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="rating">Rating</label>
                                                                 <select name="rating" class="form-control">
                                                                     <option value="1">1</option>
                                                                     <option value="2">2</option>
                                                                     <option value="3">3</option>
                                                                     <option value="4">4</option>
                                                                     <option value="5">5</option>
                                                                 </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                                                             <i class="fa fa-undo-alt"></i> Batal</button>
                                                     <button type="submit" class="btn btn-success"><span class="btn-label">
                                                             <i class="fa fa-paper-plane"></i> Kirim</span></button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- Akhir modal tambah kategori -->
                             <?php } ?>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>