 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Buku</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Buku</li>
                     </ol>
                 </nav>
             </div>
         </div>
     </div>
 </div>



 <div class="container-fluid">
     <div class="row mb-2">
         <div class="col-lg-6"></div>
         <div class="col-lg-6">
             <div class="card p-2 btn-rounded">
                 <form action="" method="post">
                     <div class="input-group">
                         <input type="text" class="form-control border-0" name="cari" placeholder="Cari Buku...">
                         <div class="input-group-append">
                             <button type="submit" class=" btn btn-success btn-rounded ml-2" name="btnCari" type="button"><i class="fas fa-search"></i> Cari</button>
                         </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <div class="card col-lg">
         <div class="card-body">

             <?php
                include "../assets/conn/koneksi.php";
                if (isset($_POST['btnCari'])) {
                    $search_query = $_POST['cari'];
                    $results_per_page = 20; // Jumlah hasil per halaman

                    // Mendapatkan jumlah data
                    $sql = "SELECT kategori.nama_kategori,COUNT(*) AS total FROM buku INNER JOIN kategori ON buku.id_kategori = kategori.id WHERE kategori.nama_kategori LIKE '%$search_query%'";

                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_results = $row['total'];

                    // Mendapatkan jumlah halaman
                    $total_pages = ceil($total_results / $results_per_page);

                    // Mendapatkan halaman saat ini
                    if (!isset($_GET['pg'])) {
                        $current_page = 1;
                    } else {
                        $current_page = $_GET['pg'];
                    }

                    // Menghitung offset untuk query database
                    $offset = ($current_page - 1) * $results_per_page;

                    // Query database dengan menggunakan LIMIT dan OFFSET


                    $query = mysqli_query($conn, "SELECT buku.id, buku.judul, kategori.id as id_kategori, rak.id as id_rak, 
                        kategori.nama_kategori, rak.nama_rak, buku.penulis, buku.penerbit, 
                        buku.foto, buku.tahun, 
                        COALESCE(SUM(ulasan_buku.rating), 0) AS total_rating, 
                        COALESCE(COUNT(ulasan_buku.rating), 0) AS jumlah_pengisi 
                    FROM buku 
                    INNER JOIN kategori ON kategori.id = buku.id_kategori 
                    INNER JOIN rak ON rak.id = buku.id_rak 
                    LEFT JOIN ulasan_buku ON ulasan_buku.id_buku = buku.id WHERE buku.judul LIKE '%$search_query%' or buku.penerbit LIKE '%$search_query%' or buku.penulis LIKE '%$search_query%' or kategori.nama_kategori LIKE '%$search_query%'
                    GROUP BY buku.id, buku.judul, kategori.id, rak.id, kategori.nama_kategori, rak.nama_rak, buku.penulis, buku.penerbit, buku.foto, buku.tahun
                    LIMIT $offset, $results_per_page");
                } else {

                    $results_per_page = 12; // Jumlah hasil per halaman

                    // Mendapatkan jumlah data
                    $sql = "SELECT COUNT(*) AS total FROM buku";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_results = $row['total'];

                    // Mendapatkan jumlah halaman
                    $total_pages = ceil($total_results / $results_per_page);

                    // Mendapatkan halaman saat ini
                    if (!isset($_GET['pg'])) {
                        $current_page = 1;
                    } else {
                        $current_page = $_GET['pg'];
                    }

                    // Menghitung offset untuk query database
                    $offset = ($current_page - 1) * $results_per_page;
                    $query = mysqli_query($conn, "SELECT buku.id, buku.judul, kategori.id as id_kategori, rak.id as id_rak, 
                        kategori.nama_kategori, rak.nama_rak, buku.penulis, buku.penerbit, 
                        buku.foto, buku.tahun, 
                        COALESCE(SUM(ulasan_buku.rating), 0) AS total_rating, 
                        COALESCE(COUNT(ulasan_buku.rating), 0) AS jumlah_pengisi 
                    FROM buku 
                    INNER JOIN kategori ON kategori.id = buku.id_kategori 
                    INNER JOIN rak ON rak.id = buku.id_rak 
                    LEFT JOIN ulasan_buku ON ulasan_buku.id_buku = buku.id 
                    GROUP BY buku.id, buku.judul, kategori.id, rak.id, kategori.nama_kategori, rak.nama_rak, buku.penulis, buku.penerbit, buku.foto, buku.tahun
                    LIMIT $offset, $results_per_page");
                }
                ?>
             <div class="row">
                 <?php while ($d = mysqli_fetch_assoc($query)) { ?>

                     <div class="col-md-3">
                         <div class="card">
                             <img src="../assets/foto/<?php echo $d['foto']; ?>" class="card-img-top" alt="Judul Buku">
                             <div class="card-body d-flex flex-column justify-content-between">
                                 <div class="d-flex align-items-center">
                                     <p class="mr-2 mb-0">Rating:</p>
                                     <?php
                                        $rata_rata_rating = 0; // Default jika pembagian tidak mungkin dilakukan

                                        // Pastikan jumlah pengisi tidak nol sebelum melakukan pembagian
                                        if ($d['jumlah_pengisi'] != 0) {
                                            $rata_rata_rating = $d['total_rating'] / $d['jumlah_pengisi'];
                                        }
                                        $rating_bulat = intval(round($rata_rata_rating));

                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating_bulat) {
                                                echo '<i class="fas fa-star text-warning"></i>';
                                            } else {
                                                echo '<i class="far fa-star text-warning"></i>';
                                            }
                                        }
                                        ?>

                                 </div>
                                 <h5 class="card-title mt-2"><?php echo $d['judul']; ?></h5>
                                 <div class="d-flex justify-content-between">
                                     <form action="backend/scr_pinjam.php" method="POST">
                                         <input type="hidden" name="page" value="2">
                                         <input type="hidden" name="id_buku" value="<?php echo $d['id']; ?>">
                                         <button type="submit" class="btn btn-primary"><i class="fas fa-heart"></i> Pinjam</button>
                                     </form>
                                     <form action="backend/scr_koleksi.php" method="POST">
                                         <input type="hidden" name="id_buku" value="<?php echo $d['id']; ?>">
                                         <button class="btn btn-warning text-white"><i class="fas fa-bookmark"></i> Koleksi</button>
                                     </form>

                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php } ?>
             </div>

             <!-- Pagination -->
             <div class="row">
                 <div class="col-md-12">
                     <ul class="pagination justify-content-center">
                         <?php for ($page = 1; $page <= $total_pages; $page++) { ?>
                             <li class="page-item <?php if (isset($_GET['pg']) && $_GET['pg'] == $page) echo 'active'; ?>">
                                 <a class="page-link" href="index.php?page=4&pg=<?php echo $page; ?>"><?php echo $page; ?></a>
                             </li>
                         <?php } ?>
                     </ul>

                 </div>
             </div>

         </div>

     </div>
 </div>
 </div>

 </div>

 <!--Modal Tambah Data Kategori -->
 <div class=" modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-lg-2" role="document">
         <div class="modal-content">
             <div class="card-header">
                 <div class="d-flex align-items-center">
                     <h4 class="card-title">Data Rak</h4>
                 </div>
             </div>
             <form action="backend/scr_tambah_rak.php" method="post">
                 <div class="modal-body">
                     <div class="row">
                         <div class="col">
                             <div class="form-group">
                                 <label for="jenis">Rak</label>
                                 <input type="text" class="form-control" id="nama_rak" name="nama_rak" placeholder="Masukkan Rak">
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
 <!-- Akhir modal tambah kategori -->