
 <?php

    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    switch ($page) {

        case "1":
            require("dashboard.php");
            break;
        case "2":
            require("kategori.php");
            break;
        case "3":
            require("rak.php");
            break;
        case "4":
            require("buku.php");
            break;
        case "5":
            require("petugas.php");
            break;
        case "6":
            require("anggota.php");
            break;
        case "7":
            require("pinjam.php");
            break;
        case "8":
            require("kembali.php");
            break;
        case "9":
            require("pengaturan.php");
            break;
        case "10":
            require("detail_kembali.php");
            break;
        case "11":
            require("ulasan.php");
            break;
    }
    ?>