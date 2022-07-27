 <a href="?page=siswa&action=add" class="btn btn-sm btn-primary mb-3">Tambah</a>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
   <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
   </div>
   <div class="card-body">
     <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
           <tr>
             <th width="3%" class="align-middle text-center">No</th>
             <th class="align-middle text-center">NISN</th>
             <th class="align-middle text-center">Nama</th>
             <th class="align-middle text-center">Kelas</th>
             <th class="align-middle text-center">Jurusan</th>
             <th class="align-middle text-center">JK</th>
             <th class="align-middle text-center">Tempat, Tanggal Lahir</th>
             <th class="align-middle text-center">Alamat</th>
             <th class="align-middle text-center">Nama Ibu Kandung</th>
             <th width="5%" class="align-middle text-center">Opsi</th>
           </tr>
         </thead>
         <tbody>
           <?php
            $no = 1;
            $sql = $conn->query("SELECT * FROM tb_siswa");
            while ($result = $sql->fetch_assoc()) {
            ?>
             <tr>
               <td><?= $no++; ?></td>
               <td><?= $result['nisn']; ?></td>
               <td><?= $result['nama_siswa']; ?></td>

               <?php
                $id_kelas = $result['id_kelas'];
                $kelas = $conn->query("SELECT * FROM tb_kelas WHERE id_kelas = '$id_kelas'");
                while ($resultKelas = $kelas->fetch_assoc()) {
                ?>
                 <td><?= $resultKelas['kelas']; ?></td>
               <?php } ?>

               <?php
                $id_jurusan = $result['id_jurusan'];
                $jurusan = $conn->query("SELECT * FROM tb_jurusan WHERE id_jurusan = '$id_jurusan'");
                while ($resultjurusan = $jurusan->fetch_assoc()) {
                ?>
                 <td><?= $resultjurusan['jurusan']; ?></td>
               <?php } ?>

               <td><?= $result['jk']; ?></td>
               <td><?= $result['tempat_lahir']; ?>, <?= date('d-m-Y', strtotime($result['tanggal_lahir'])); ?></td>
               <td><?= $result['alamat']; ?></td>
               <td><?= $result['nama_ibu']; ?></td>
               <td>
                 <a href="?page=siswa&action=edit&id=<?= $result['id_siswa']; ?>" data-toggle="tooltip" data-placement="top" title="edit"><i class="fas fa-fw fa-edit text-success"></i></a>
                 <a href="?page=siswa&action=delete&id=<?= $result['id_siswa']; ?>" onclick="return confirm('Anda Yakin akan menghapus data ini...?')" data-toggle="tooltip" data-placement="top" title="delete"><i class="fas fa-fw fa-trash-alt text-danger"></i></a>
               </td>
             </tr>
           <?php } ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>