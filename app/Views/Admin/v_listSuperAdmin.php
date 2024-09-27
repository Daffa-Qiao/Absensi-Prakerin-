<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<style>
    .card {
        border-radius: 0 0 .35rem .35rem;
    }
</style>
<!-- Begin Page Content -->

<div class="container-fluid p-0">
    <!-- DataTales Example -->
    <div class="title text-dark font-weight-bold px-1 rounded-top mt-5 pl-3">
        List Super Admin
    </div>
    <div class="card shadow mb-2">
        <div class="card-body border-bottom">
            <div class="table-responsive">
                <table class="table table-bordered" id="dTable" width="100%" cellspacing="0" id="dataSiswa">
                    <thead class="border">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>NIM / NIS</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Role</th>
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
                                    <?= $v['no_hp']; ?>
                                </td>
                                <td>
                                    <?= $v['level'] ?>
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
    <?php if (session()->getFlashdata('swal_icon')) : ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    <?php endif; ?>

    function super_admin_edit($id) {
        $.ajax({
            url: "<?= site_url('admin/superadmin/super_admin_edit') ?>/" + $id,
            type: "GET",
            success: function(hasil) {
                var $obj = $.parseJSON(hasil);
                if ($obj.id != "") {
                    $("#superId").val($obj.member_id);
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
</script>
<?= $this->endSection(); ?>