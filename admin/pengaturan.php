 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Pengaturan</li>
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
                     <div class="col-md-6">
                         <?php
                            include "../assets/conn/koneksi.php";
                            $query = mysqli_query($conn, "SELECT * FROM pengaturan limit 1");
                            $row = mysqli_num_rows($query);
                            if ($row > 0) {
                                while ($d = mysqli_fetch_assoc($query)) {



                            ?>
                                 <form action="backend/scr_ubah_pengaturan.php" method="POST">
                                     <div class="form-group">
                                         <label for="lama">Lama Peminjaman</label>
                                         <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                                         <input type="number" name="lama_pinjam" class="form-control" value="<?php echo $d['lama_pinjam']; ?>">
                                     </div>
                                     <div class="form-group">
                                         <label for="Denda">Denda</label>
                                         <input type="number" name="denda" class="form-control" value="<?php echo $d['denda']; ?>">
                                     </div>
                                     <div class="form-group">
                                         <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                         <button class="btn btn-danger"><i class="fas fa-undo-alt"></i> Batal</button>
                                     </div>
                                 </form>
                             <?php }
                            } else { ?>
                             <form action="backend/scr_pengaturan.php" method="POST">
                                 <div class="form-group">
                                     <label for="lama">Lama Peminjaman</label>
                                     <input type="number" name="lama_pinjam" class="form-control">
                                 </div>
                                 <div class="form-group">
                                     <label for="Denda">Denda</label>
                                     <input type="number" name="denda" class="form-control">
                                 </div>
                                 <div class="form-group">
                                     <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                     <button class="btn btn-danger"><i class="fas fa-undo-alt"></i> Batal</button>
                                 </div>
                             </form>
                         <?php } ?>

                     </div>

                 </div>
             </div>
         </div>
     </div>

 </div>