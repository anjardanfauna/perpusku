<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../");
}
?>
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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Perpustakaan Digital Smk Informatika Sumedang</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="../assets/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php include "template/topbar.php"; ?>
        <?php include "template/sidebar.php"; ?>

        <div class="page-wrapper">
            <?php include "load.php"; ?>
            <footer class="footer text-center text-muted">
                All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
    </div>



    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/dist/js/app-style-switcher.js"></script>
    <script src="../assets/dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

    <script src="../assets/dist/js/sidebarmenu.js"></script>
    <script src="../assets/dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/dist/js/pages/dashboards/dashboard1.min.js"></script>
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
                $('#foto').attr('src', '../assets/foto/' + obj.foto);
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
                $('#foto2').attr('src', '../assets/foto/' + obj.foto);
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