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
                                 <th>Status</th>

                             </thead>
                             <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT peminjaman.id, pengguna.id as id_pengguna, buku.id as id_buku, buku.foto, buku.judul, peminjaman.tanggal_pinjam, peminjaman.status_peminjaman 
                                FROM peminjaman 
                                INNER JOIN pengguna ON peminjaman.id_pengguna = pengguna.id 
                                INNER JOIN buku ON peminjaman.id_buku = buku.id 
                                WHERE peminjaman.status_peminjaman = '0' or peminjaman.status_peminjaman = 'pinjam'  AND id_pengguna = " . $_SESSION['id']);


                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                 <tr>
                                     <td><?php echo $no++ ?></td>
                                     <td><?php echo $d['judul']; ?></td>
                                     <td><?php echo $d['tanggal_pinjam']; ?></td>
                                     <?php
                                        include "../assets/conn/koneksi.php";
                                        $lama = mysqli_query($conn, "SELECT * FROM pengaturan LIMIT 1");
                                        $row = mysqli_fetch_assoc($lama);
                                        $lama_pinjam = $row['lama_pinjam'];

                                        $new_date = date('Y-m-d', strtotime($d['tanggal_pinjam'] . '+' . $lama_pinjam . ' days'));
                                        ?>

                                     <td><?php echo $new_date; ?></td>


                                     <td><?php if ($d['status_peminjaman'] == '0') {
                                                echo 'Menunggu Konfirmasi';
                                            } else {
                                                echo $d['status_peminjaman'];
                                            } ?></td>

                                 </tr>
                             <?php } ?>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>