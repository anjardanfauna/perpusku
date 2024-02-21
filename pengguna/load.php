
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
            require("buku.php");
            break;
        case "3":
            require("pinjam.php");
            break;
        case "4":
            require("koleksi.php");
            break;
        case "5":
            require("kembali.php");
            break;
        case "6":
            require("ulasan.php");
            break;
    }
    ?>