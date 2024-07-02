<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<?php include(APPPATH . 'Views/Admin/Modal/modalSuper.php'); ?>
<div class="container-fluid p-0">
    <!-- DataTales Example -->
    <div class="title text-dark font-weight-bold px-1 rounded-top mt-5 pl-3">
        List Data User
    </div>
    <div class="card shadow mb-2">
        <div class="card-body border-bottom">
            <div class="table-responsive">
                <table class="table table-bordered" id="dTable" width="100%" cellspacing="0" id="dataSiswa">
                    <thead class="border">
                        <tr>
                            <th class="text-center">No</th>
                            <th style="min-width: 200px">Nama Lengkap</th>
                            <th style="min-width: 100px">NIM / NIS</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th style="width: 210px; min-width: 250px;">Password</th>
                            <th>No. Telepon</th>
                            <th style="min-width: 100px">Role</th>
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        <?php foreach ($dataUser as $v) {

                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $nomor; ?>
                                </td>
                                <td>
                                    <?= $v['nama_lengkap']; ?>
                                </td>
                                <td>
                                    <?= $v['nim_nis']; ?>
                                </td>
                                <td>
                                    <?= $v['username']; ?>
                                </td>
                                <td>
                                    <?= $v['email']; ?>
                                </td>
                                <td>
                                    <input type="password" value="<?= $v['password']; ?>"
                                        style="outline: none; border: none; text-align: center; cursor: default;width: 50%;"
                                        id="<?= $v['member_id']; ?>" readonly>

                                    <span id="mata<?= $v['member_id']; ?>" onclick="change(<?= $v['member_id']; ?>)"
                                        style="cursor: pointer;">
                                        <i class="fa-regular fa-eye fa-xl"></i>
                                    </span>
                                </td>
                                <td>
                                    <?= $v['no_hp']; ?>
                                </td>
                                <td>
                                    <?= $v['level'] ?>
                                </td>
                                <td>
                                    <?php if ($v['member_id'] != session('member_id')): ?>
                                        <a class="btn btn-danger btn-circle mb-1" onclick="hapus(<?= $v['member_id'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a class="btn btn-warning btn-circle mb-1" data-toggle="modal"
                                            data-target="#modalsuperAdmin" onclick="super_admin_edit(<?= $v['member_id'] ?>)">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    <?php endif ?>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('role_icon')): ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('role_icon'); ?>',
            title: '<?= session()->getFlashdata('role_title'); ?>',
        })
    <?php endif; ?>
    <?php if (session()->getFlashdata('swal_icon')): ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    <?php endif; ?>

    function super_admin_edit($id) {
        $.ajax({
            url: "<?= site_url('Admin/SuperAdmin/super_admin_edit') ?>/" + $id,
            type: "GET",
            success: function (hasil) {
                var $obj = $.parseJSON(hasil);
                if ($obj.id != "") {
                    $("#superId").val($obj.member_id);
                    $("#dataNim_Nis").val($obj.nim_nis);
                    $("#superNamaLengkap").val($obj.nama_lengkap);
                    $("#superNimNis").val($obj.nim_nis);
                    $("#superUsername").val($obj.username);
                    $("#superPassword").val($obj.password);
                    $("#superNoHP").val($obj.no_hp);
                    $("#superEmail").val($obj.email);
                    $("#superRole").val($obj.level);
                }
            },
        });
    }

    function change($id) {
        var password = document.getElementById($id);
        var mata = document.getElementById('mata' + $id);

        if (password.type == 'password') {
            password.type = 'text';
            mata.innerHTML = `<i class="fa-regular fa-eye-slash fa-xl" style="z-index:2;"></i>`;
        } else {
            password.type = 'password';
            mata.innerHTML = `<i class="fa-regular fa-eye fa-xl"></i>`;
        }
    }
</script>
<?= $this->endSection(); ?>