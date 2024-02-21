 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Kategori</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Kategori</li>
                     </ol>
                 </nav>
             </div>
         </div>

     </div>
 </div>

 <div class="container-fluid">
     <div class="row">
         <div class="col-12">
             <div class="page-header mb-3">
                 <div class="d-flex align-items-center">
                     <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambahDataModal">
                         <i class="fa fa-plus"></i>
                         Tambah Data
                     </button>
                 </div>
             </div>
             <div class="card">

                 <div class="card-body">
                     <div class="table-responsive">
                         <table id="example" class="display table table-striped table-bordered table-hover">
                             <thead>
                                 <th width=20px>No</th>
                                 <th>Nama kategori</th>
                                 <th width=100px>Aksi</th>
                             </thead>
                             <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM kategori");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                 <tr>
                                     <td><?php echo $no++ ?></td>
                                     <td><?php echo $d['nama_kategori']; ?></td>
                                     <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>
                                         <a href="backend/scr_hapus_kategori.php?id_kategori=<?php echo $d['id']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
                                     </td>
                                 </tr>
                                 <!--Modal Ubah Data Kategori -->
                                 <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                     <div class="modal-dialog modal-lg-2" role="document">
                                         <div class="modal-content">
                                             <div class="card-header">
                                                 <div class="d-flex align-items-center">
                                                     <h4 class="card-title">Ubah Kategori</h4>
                                                 </div>
                                             </div>
                                             <form action="backend/scr_ubah_kategori.php" method="post">
                                                 <div class="modal-body">
                                                     <div class="row">
                                                         <div class="col">
                                                             <div class="form-group">
                                                                 <input type="hidden" name="id_kategori" value="<?php echo $d['id']; ?>">
                                                                 <label for="jenis">Kategori</label>
                                                                 <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo $d['nama_kategori']; ?>">
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
                                 <!-- Akhir modal ubah kategori -->
                             <?php } ?>
                         </table>
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
                     <h4 class="card-title">Data Kategori</h4>
                 </div>
             </div>
             <form action="backend/scr_tambah_kategori.php" method="post">
                 <div class="modal-body">
                     <div class="row">
                         <div class="col">
                             <div class="form-group">
                                 <label for="jenis">Kategori</label>
                                 <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Kategori">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                             <i class="fa fa-undo-alt"></i> Batal</button>
                     <button type="submit" class="btn btn-success"><span class="btn-label">
                             <i class="fas fa-save"></i> Simpan</span></button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- Akhir modal tambah kategori -->