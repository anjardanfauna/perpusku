 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Koleksi</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Koleksi</li>
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

                    $results_per_page = 8; // Jumlah hasil per halaman
                    $id_pengguna = isset($_SESSION['id']) ? $_SESSION['id'] : '';
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

                    // Query database dengan menggunakan LIMIT dan OFFSET
                    $query = mysqli_query($conn, "SELECT koleksi_pribadi.id as id_koleksi,koleksi_pribadi.id_pengguna,koleksi_pribadi.id_buku,buku.id,buku.judul,buku.penulis,buku.penerbit,buku.foto,buku.tahun,pengguna.* FROM koleksi_pribadi INNER JOIN buku ON koleksi_pribadi.id_buku=buku.id INNER JOIN pengguna ON koleksi_pribadi.id_pengguna = pengguna.id WHERE pengguna.id='$id_pengguna' LIMIT $offset, $results_per_page");
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
                                            // Misalnya rating adalah 4
                                            $rating = 4;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
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
                                             <input type="hidden" name="no" value="4">
                                             <input type="hidden" name="id_buku" value="<?php echo $d['id_buku']; ?>">
                                             <button type="submit" class="btn btn-primary"><i class="fas fa-heart"></i> Pinjam</button>
                                         </form>
                                         <form action="backend/scr_hapus_koleksi.php?id_koleksi=<?php echo $d['id_koleksi']; ?>" method="POST">
                                             <button class="btn btn-danger text-white"><i class="fas fa-trash"></i> Hapus</button>
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
                                     <a class="page-link" href="index.php?page=2&pg=<?php echo $page; ?>"><?php echo $page; ?></a>
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