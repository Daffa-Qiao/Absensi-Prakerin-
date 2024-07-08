<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->

<?php include(APPPATH . 'Views/Admin/Modal/modalTambah.php'); ?>
<?php include(APPPATH . 'Views/Admin/Modal/modalEdit.php'); ?>
<div class="container-fluid p-0">
    <div class="wrapper-addUser text-dark bg-info d-flex w-25 p-2 my-3 rounded-lg shadow-sm" style="min-width: 300px">
        <input type="button" id="but" data-toggle="modal" data-target="#exampleModal" hidden></input>
        <label for="but" class="w-100 h-100 d-flex align-items-center" style="min-width: 200px; ">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Tambah User Baru
        </label>
    </div>
    <!-- DataTales Example -->
    <div class="title text-dark font-weight-bold px-1 rounded-top mt-5 pl-3">List Data Siswa</div>
    <div class="card shadow mb-2">
        <div class="card-body border-bottom">
            <div class="table-responsive">
                <table class="table table-bordered" id="dTable" width="100%" cellspacing="0">
                    <thead class="border">
                        <tr>
                            <th>No</th>
                            <th style="min-width: 200px">Nama Lengkap</th>
                            <th style="min-width: 150px">Asal Instansi</th>
                            <th>Username</th>
                            <th style="min-width:120px">Jenis Kelamin</th>
                            <th>Profil</th>
                            <th style="min-width: 100px">NIM / NIS</th>
                            <th style="min-width: 200px">Tanggal Bergabung</th>
                            <th style="min-width: 100px; font-family: 'Times New Roman', Times, serif; font-size:14px"><strong>Status</strong></th>
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        <?php foreach ($dataSiswa as $v) {
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor; ?>
                                </td>
                                <td>
                                    <?= $v['nama_lengkap']; ?>
                                </td>
                                <td>
                                    <?= $v['nama_instansi']; ?>
                                </td>
                                <td>
                                    <?= $v['username']; ?>
                                </td>
                                <td>
                                    <?= $v['jenis_kelamin']; ?>
                                </td>
                                <td>
                                    <?php if ($v['foto'] != ''): ?>
                                        <img src="<?= base_url('uploadFoto/' . $v['foto']) ?>" alt=""
                                            onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $v['foto']) ?>')">
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?= $v['nim_nis']; ?>
                                </td>
                                <td>
                                    <?= tanggal_indo($v['tanggal_bergabung']) ?>
                                </td>
                                <td style="font-size:12px;background-color: #00FF7F;">
                                    <?= $v['status']; ?>
                                </td>
                                <td>
                                    <?php if (session('member_id') != $v['member_id']): ?>
                                        <a class="btn btn-danger btn-circle mb-1" onclick="hapus(<?= $v['member_id'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php endif ?>
                                    <a href="#" class="btn btn-warning btn-circle mb-1" data-toggle="modal"
                                        data-target="#modalEdit" onclick="edit(<?= $v['member_id'] ?>)">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $nomor++;
                        } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('swal_icon')): ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>