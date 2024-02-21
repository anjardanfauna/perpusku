<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Perpustakaan Digital Smk Informatika Sumedang</title>
    <!-- Custom CSS -->
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="assets/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>



    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-4 mb-2"><img src="assets/images/logo-if.png" class="mr-2" width="40"><img src="assets/images/logo-text.png" alt=""></div>
                <div class="col-lg-6">
                    <div class="card p-2 btn-rounded">
                        <form action="" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control border-0" name="cari" placeholder="Cari Buku...">


                                <button type="submit" class=" btn btn-md btn-success btn-rounded ml-2" name="btnCari" type="button"><i class="fas fa-search"></i> Cari</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group m-2 justify-content-end">
                        <a href="daftar.php" class="btn btn-md btn-rounded btn-outline-success border-0  w-50"><i class="far fa-id-card m-2"></i>Daftar</a>
                        <a href="login.php" class="btn btn-md btn-rounded btn-outline-success border-0 w-50"><i class="far fa-user m-2"></i>Masuk</a>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="card col-lg">
                    <div class="card-body">

                        <?php
                        include "assets/conn/koneksi.php";
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

                            $results_per_page = 20; // Jumlah hasil per halaman

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
                                        <img src="assets/foto/<?php echo $d['foto']; ?>" class="card-img-top" alt="Judul Buku">
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


    <footer class="footer text-center text-muted">
        Copyright &copy; If-Teach <?php echo date('Y'); ?>
    </footer>
    </div>
    </div>



    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/js/app-style-switcher.js"></script>
    <script src="assets/dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

    <script src="assets/dist/js/sidebarmenu.js"></script>
    <script src="assets/dist/js/custom.min.js"></script>
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/dist/js/pages/dashboards/dashboard1.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable(); // Inisialisasi DataTables
        });

        function cek_anggota() {
            var id_anggota = $("#id_anggota2").val();
            $.ajax({
                url: 'backend/get_anggota.php',
                data: "id=" + id_anggota,
            }).success(function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#alamat').val(obj.alamat);
                $('#email').val(obj.email);
            });
        }

        function cek_anggota2() {
            var id_anggota = $("#id_anggota").val();
            $.ajax({
                url: 'backend/get_anggota.php',
                data: "id=" + id_anggota,
            }).success(function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#alamat2').val(obj.alamat);
                $('#email2').val(obj.email);
            });
        }

        function cek_buku() {
            var id_buku = $("#id_foto").val();
            $.ajax({
                url: 'backend/get_buku.php',
                data: "id=" + id_buku,
            }).success(function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#foto').attr('src', 'assets/foto/' + obj.foto);
            });
        }

        function cek_buku2() {
            var id_buku = $("#id_foto2").val();
            $.ajax({
                url: 'backend/get_buku.php',
                data: "id=" + id_buku,
            }).success(function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#foto2').attr('src', 'assets/foto/' + obj.foto);
            });
        }
    </script>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                    $('#previewImg').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>

</html>