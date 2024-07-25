<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<style>
    .card {
        border-radius: 0 0 .35rem .35rem;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid p-0">
    <div class="container-fluid d-flex mt-3 p-0">
        <div class="row row-cols-2">
            <div class="col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    School
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800" name="sekolah">
                                    <?= $totalSekolah ?>
                                </div>
                                <div class="font-weight-bold text-primary mt-1">
                                    <a href="<?= site_url('admin/instansi-sekolah') ?>">Info
                                        <i class="fa-regular fa-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-3">
                                <div class="text-xl font-weight-bold text-info text-uppercase mb-1" style="width: 100px;">
                                    Student
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800" name="card-ssw">
                                    <?= $totalSiswa ?>
                                </div>
                                <div class="font-weight-bold text-primary mt-1">
                                    <a href="<?= site_url('admin/data-siswa'); ?>">Info
                                        <i class="fa-regular fa-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                    Total User
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800" name="aktif">
                                    <?= $totalUser; ?>
                                </div>
                                <?php if (session('redirected') == 'superadmin') : ?>
                                    <div class="font-weight-bold text-primary mt-1">
                                        <a href="<?= site_url('admin/super-admin'); ?>">Info
                                            <i class="fa-regular fa-circle-right"></i>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    University
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800" name="univ">
                                    <?= $totalUniv ?>
                                </div>
                                <div class="font-weight-bold text-primary mt-1">
                                    <a href="<?= site_url('admin/instansi-universitas') ?>">Info
                                        <i class="fa-regular fa-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-info text-uppercase mb-1">
                                    College Student
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800" name="card-mhs">
                                    <?= $totalMahasiswa ?>
                                </div>
                                <div class="font-weight-bold text-primary mt-1">
                                    <a href="<?= site_url('admin/data-mahasiswa'); ?>">Info
                                        <i class="fa-regular fa-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                    Total Super Admin
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800" name="aktif">
                                    <?= $totalSuperAdmin; ?>
                                </div>
                                <div class="font-weight-bold text-primary mt-1">
                                    <a href="<?= site_url('admin/list-super-admin'); ?>">Info
                                        <i class="fa-regular fa-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-rectangle-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title text-dark font-weight-bold px-1 rounded-top mt-2 pl-3">This Month's Absence Update</div>
    <div class="card shadow mb-2">
        <div class="card-body border-bottom">
            <div class="table-responsive">
                <table class="table table-bordered" id="dTable" width="100%" cellspacing="0">
                    <thead class="border">
                        <tr>
                            <th class="">User</th>
                            <th class="" style="width: 100px;">Attended</th>
                            <th class="" style="width: 100px;">Permit</th>
                            <th class="" style="width: 100px;">Sick</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        <?php foreach ($dataAbsen as $v) {
                            $dataUser = $user->where('nim_nis', $v->nim_nis)->get()->getRow();

                            $profil = $dataUser ? $dataUser->foto : 'profile.png';
                            $namaLengkap = $dataUser ? $dataUser->nama_lengkap : 'User Telah Dihapus';
                            $nama_instansi = $dataUser ? $dataUser->nama_instansi : '';
                            $jenis_user = $dataUser ? $dataUser->jenis_user : $v->jenis_user;
                            if ($jenis_user == 'Student') {
                                $jenis = 'text-success';
                            } else if ($jenis_user == 'College Student') {
                                $jenis = 'text-primary';
                            }
                        ?>
                            <tr>
                                <td class="dashboard">
                                    <img src="<?= base_url('uploadFoto/' . $profil) ?>" alt="" onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $profil) ?>')" />
                                    <div class="wrapper-tdSatu">
                                        <p class="dashboard nama" name="nama">
                                            <?= $namaLengkap ?>
                                        </p>
                                        <p class="dashboard font-weight-bold <?= $jenis ?>" name="ssw">
                                            <?= $nama_instansi ?>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <?= $totalAbsensi[$v->nim_nis]['masuk']; ?>
                                </td>
                                <td>
                                    <?= $totalAbsensi[$v->nim_nis]['izin']; ?>
                                </td>
                                <td>
                                    <?= $totalAbsensi[$v->nim_nis]['sakit']; ?>
                                </td>
                            </tr>
                        <?php
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('swal_icon')) : ?> Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
        })
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>