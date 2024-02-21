 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
                     </ol>
                 </nav>
             </div>
         </div>
     </div>
 </div>

 <div class="container-fluid">

     <div class="card-group">
         <div class="card border-right">
             <div class="card-body">
                 <div class="d-flex d-lg-flex d-md-block align-items-center">
                     <div>
                         <div class="d-inline-flex align-items-center">
                             <h2 class="text-dark mb-1 font-weight-medium">
                                 <?php
                                    include "../assets/conn/koneksi.php";

                                    $query = mysqli_query($conn, "SELECT COUNT(id) AS total FROM peminjaman WHERE id_pengguna=" . $_SESSION['id']);
                                    $result = mysqli_fetch_assoc($query);
                                    $total = $result['total'];
                                    echo $total;
                                    ?>
                             </h2>
                         </div>
                         <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Peminjaman</h6>
                     </div>
                     <div class="ml-auto mt-md-3 mt-lg-0">
                         <span class="opacity-7 text-muted"><i data-feather="grid"></i></span>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card border-right">
             <div class="card-body">
                 <div class="d-flex d-lg-flex d-md-block align-items-center">
                     <div>
                         <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                             <?php
                                include "../assets/conn/koneksi.php";
                                $query = mysqli_query($conn, "SELECT COUNT(pengembalian.id) AS total, pengembalian.id_peminjaman, peminjaman.id, peminjaman.id_pengguna 
                              FROM pengembalian 
                              INNER JOIN peminjaman ON pengembalian.id_peminjaman = peminjaman.id 
                              WHERE id_pengguna = '" . $_SESSION['id'] . "'
                              GROUP BY pengembalian.id_peminjaman, peminjaman.id");

                                $result = mysqli_fetch_assoc($query);
                                if ($result !== null && isset($result['total'])) {
                                    $total = $result['total'];
                                    echo $total;
                                } else {
                                    echo '0';
                                }

                                ?></h2>
                         <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pengembalian
                         </h6>
                     </div>
                     <div class="ml-auto mt-md-3 mt-lg-0">
                         <span class="opacity-7 text-muted"><i data-feather="grid"></i></span>
                     </div>
                 </div>
             </div>
         </div>

         <div class="card">
             <div class="card-body">
                 <div class="d-flex d-lg-flex d-md-block align-items-center">
                     <div>
                         <h2 class="text-dark mb-1 font-weight-medium">
                             <?php
                                include "../assets/conn/koneksi.php";

                                $query = mysqli_query($conn, "SELECT COUNT(id) AS total FROM ulasan_buku WHERE id_pengguna=" . $_SESSION['id']);
                                $result = mysqli_fetch_assoc($query);
                                $total = $result['total'];
                                echo $total;
                                ?>
                         </h2>
                         <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Ulasan</h6>
                     </div>
                     <div class="ml-auto mt-md-3 mt-lg-0">
                         <span class="opacity-7 text-muted"><i data-feather="message-square"></i></span>
                     </div>
                 </div>
             </div>
         </div>
     </div>


     <!-- *************************************************************** -->
     <!-- End Location and Earnings Charts Section -->
     <!-- *************************************************************** -->
     <!-- *************************************************************** -->
     <!-- Start Top Leader Table -->
     <!-- *************************************************************** -->
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-4">
                         <h4 class="card-title">Pengajuan Peminjaman Buku</h4>

                     </div>
                     <div class="table-responsive">
                         <table id="example" class="display table table-striped table-bordered table-hover">
                             <thead>
                                 <th width=20px>No</th>
                                 <th>Judul</th>
                                 <th>Tanggal Pinjam</th>
                                 <th>Status</th>
                                 <th width=100px>Aksi</th>
                             </thead>
                             <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT peminjaman.id, pengguna.id as id_pengguna, buku.id as id_buku, buku.foto, buku.judul, peminjaman.tanggal_pinjam, peminjaman.status_peminjaman 
                                FROM peminjaman 
                                INNER JOIN pengguna ON peminjaman.id_pengguna = pengguna.id 
                                INNER JOIN buku ON peminjaman.id_buku = buku.id 
                                WHERE peminjaman.status_peminjaman = '0'  AND id_pengguna = " . $_SESSION['id']);


                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                 <tr>
                                     <td><?php echo $no++ ?></td>
                                     <td><?php echo $d['judul']; ?></td>
                                     <td><?php echo $d['tanggal_pinjam']; ?></td>
                                     <td><?php if ($d['status_peminjaman'] == '0') {
                                                echo 'Menunggu Konfirmasi';
                                            } else {
                                                echo $d['status_peminjaman'];
                                            } ?></td>
                                     <td>
                                         <a href="backend/scr_hapus_pinjam.php?id_pinjam=<?php echo $d['id']; ?>" class="btn btn-danger btn-block m-1"><i class="fas fa-trash-alt"></i></a>
                                     </td>
                                 </tr>
                             <?php } ?>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- *************************************************************** -->
     <!-- End Top Leader Table -->
     <!-- *************************************************************** -->
 </div>