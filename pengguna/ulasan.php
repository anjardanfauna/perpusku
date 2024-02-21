 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">History Ulasan</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Ulasan</li>

                     </ol>
                 </nav>
             </div>
         </div>
     </div>
 </div>


 <div class="container-fluid">
     <div class="row">
         <div class="card col-lg">
             <div class="card-body">
                 <?php
                    include "../assets/conn/koneksi.php";
                    $result = mysqli_query($conn, "SELECT ulasan_buku.id_pengguna,ulasan_buku.id_buku,ulasan_buku.ulasan,buku.judul,buku.foto,pengguna.nama_pengguna,ulasan_buku.rating,ulasan_buku.waktu FROM ulasan_buku INNER JOIN buku ON ulasan_buku.id_buku = buku.id INNER JOIN pengguna ON ulasan_buku.id_pengguna=pengguna.id ORDER BY ulasan_buku.waktu DESC");
                    if (mysqli_num_rows($result) > 0) {
                        // Output data dari setiap baris
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                         <div class="row">
                             <div class="col-lg-1">
                                 <img src="../assets/foto/<?php echo $row['foto']; ?>" width="80">
                             </div>
                             <div class="col-lg">
                                 <div class="text-dark font-weight-medium"><?php echo $row['judul']; ?></div>
                                 <div class="row">
                                     <div class="col-lg">
                                         Rating :
                                         <?php
                                            $rating_bulat = $row['rating'];
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating_bulat) {
                                                    echo '<i class="fas fa-star text-warning"></i>';
                                                } else {
                                                    echo '<i class="far fa-star text-warning"></i>';
                                                }
                                            }
                                            ?>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-lg text-dark">
                                         <div class="row">
                                             <div class="col-lg-2"><?php echo $row['nama_pengguna']; ?></div>

                                             <div class="col-lg">: <?php echo $row['ulasan']; ?></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-2 text-right text-muted">
                                 <?php echo $row['waktu']; ?>
                             </div>
                         </div>


                         <hr>
                 <?php }
                    } else {
                        echo "0";
                    } ?>
             </div>
         </div>
     </div>
 </div>