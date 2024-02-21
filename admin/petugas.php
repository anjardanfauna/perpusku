 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-7 align-self-center">
             <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Petugas</h3>
             <div class="d-flex align-items-center">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb m-0 p-0">
                         <li class="breadcrumb-item"><a href="index.php?page=1" class="text-muted">Home</a></li>
                         <li class="breadcrumb-item text-muted active" aria-current="page">Petugas</li>
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
                                 <th>Nama Petugas</th>
                                 <th>Alamat</th>
                                 <th>Username</th>
                                 <th>Level</th>
                                 <th width=100px>Aksi</th>
                             </thead>
                             <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM petugas");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                 <tr>
                                     <td><?php echo $no++ ?></td>
                                     <td><?php echo $d['nama_petugas']; ?></td>
                                     <td><?php echo $d['alamat']; ?></td>
                                     <td><?php echo $d['username']; ?></td>
                                     <td><?php echo $d['level']; ?></td>
                                     <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>
                                         <a href="backend/scr_hapus_petugas.php?id_petugas=<?php echo $d['id']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
                                     </td>
                                 </tr>
                                 <!-- Modal Ubah  -->
                                 <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                     <div class="modal-dialog modal-lg-6" role="document">
                                         <div class="modal-content">
                                             <div class="card-header">
                                                 <div class="d-flex align-items-center">
                                                     <h4 class="card-title">Data Petugas</h4>
                                                 </div>
                                             </div>
                                             <form action="backend/scr_ubah_petugas.php" id="resetbuku" method="POST">
                                                 <div class="modal-body">
                                                     <!-- Grid System untuk dua kolom -->
                                                     <div class="row">
                                                         <div class="col-lg">
                                                             <!-- Isi formulir di kolom pertama -->
                                                             <div class="form-group">
                                                                 <input type="hidden" name="id_petugas" value="<?php echo $d['id']; ?>">
                                                                 <label for="nama petugas">Nama Petugas</label>

                                                                 <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?php echo $d['nama_petugas']; ?>">
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="alamat">Alamat</label>
                                                                 <textarea name="alamat" class="form-control" id="" rows="3"><?php echo $d['alamat']; ?></textarea>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="username">Username</label>
                                                                 <input type="text" class="form-control" name="username" value="<?php echo $d['username']; ?>">
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="password">Password</label>
                                                                 <input type="password" class="form-control" name="password" value="<?php echo $d['password']; ?>">
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="level">Level</label>
                                                                 <select name="level" class="form-control">
                                                                     <?php
                                                                        if ($d['level'] == 'admin') {
                                                                            echo '<option value="admin">Administrator</option>';
                                                                        } else {
                                                                            echo '<option value="petugas">Petugas</option>';
                                                                        }
                                                                        ?>

                                                                     <option value="admin">Administrator</option>
                                                                     <option value="petugas">Petugas</option>
                                                                 </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                                                             <i class="fa fa-undo-alt"></i> Batal</button>
                                                     <button type="submit" class="btn btn-success"><span class="btn-label">
                                                             <i class="fa fa-save"></i> Simpan</span></button>
                                                 </div </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- Akhir Modal Ubah  -->
                             <?php } ?>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>

 <!-- Modal Tambah Buku -->
 <div class=" modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-lg-6" role="document">
         <div class="modal-content">
             <div class="card-header">
                 <div class="d-flex align-items-center">
                     <h4 class="card-title">Data Petugas</h4>
                 </div>
             </div>
             <form action="backend/scr_tambah_petugas.php" id="resetbuku" method="post" enctype="multipart/form-data">
                 <div class="modal-body">
                     <!-- Grid System untuk dua kolom -->
                     <div class="row">
                         <div class="col-lg">
                             <!-- Isi formulir di kolom pertama -->
                             <div class="form-group">
                                 <label for="nama petugas">Nama Petugas</label>
                                 <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Masukkan nama petugas">
                             </div>
                             <div class="form-group">
                                 <label for="alamat">Alamat</label>
                                 <textarea name="alamat" class="form-control" id="" rows="3" placeholder="Masukan alamat"></textarea>
                             </div>
                             <div class="form-group">
                                 <label for="username">Username</label>
                                 <input type="text" class="form-control" name="username" placeholder="Masukan username">
                             </div>
                             <div class="form-group">
                                 <label for="password">Password</label>
                                 <input type="password" class="form-control" name="password" placeholder="Masukan password">
                             </div>
                             <div class="form-group">
                                 <label for="level">Level</label>
                                 <select name="level" class="form-control">
                                     <option value="admin">Administrator</option>
                                     <option value="petugas">Petugas</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                             <i class="fa fa-undo-alt"></i> Batal</button>
                     <button type="submit" class="btn btn-success"><span class="btn-label">
                             <i class="fa fa-save"></i> Simpan</span></button>
                 </div </form>
         </div>
     </div>
 </div>
 <!-- Akhir Modal Buku -->