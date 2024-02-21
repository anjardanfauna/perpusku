 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Pengembalian</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Detail Pengembalian</li>
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
                     <a href="index.php?page=8" class="btn btn-primary btn-round ml-auto">
                         <i class="fas fa-info-circle"></i>
                         Konfirmasi
                     </a>
                 </div>
             </div>
             <div class="card">

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="example" class="display table table-striped table-hover">
                             <thead>
                                 <th width=20px>No</th>
                                 <th>Nama Anggota</th>
                                 <th>Judul</th>
                                 <th>Tanggal Pinjam</th>
                                 <th>Tanggal Kembali</th>
                                 <th>Denda</th>
                             </thead>
                             <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT pengembalian.*,peminjaman.*,buku.judul,pengguna.nama_pengguna FROM pengembalian INNER JOIN peminjaman ON pengembalian.id_peminjaman = peminjaman.id INNER JOIN buku ON peminjaman.id_buku = buku.id INNER JOIN pengguna ON peminjaman.id_pengguna=pengguna.id");

                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                 <tr>
                                     <td><?php echo $no++ ?></td>
                                     <td><?php echo $d['nama_pengguna']; ?></td>
                                     <td><?php echo $d['judul']; ?></td>
                                     <td><?php echo $d['tanggal_pinjam']; ?></td>
                                     <td><?php echo $d['tanggal_kembali']; ?></td>
                                     <td><?php echo 'Rp ' . number_format($d['denda'], 0, ',', '.'); ?></td>

                                 </tr>
                             <?php } ?>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>