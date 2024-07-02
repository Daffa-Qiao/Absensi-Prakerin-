<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->


<div class="container-fluid">
    <div class="wrapper-profile">
        <div class="profile-body">
            <?php $namaFile = session()->get('member_foto') ?>
            <div id="display_image"></div>
            <img src="<?= base_url('uploadFoto/' . $namaFile); ?>" id="logo"
                onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $namaFile); ?>')">
        </div>
    </div>
    <div class="text-center mt-3">
        <label class="btn btn-primary bg-primary bg-gradient" style=" border: none;" for="upload">Pilih
            Gambar</label>
    </div>
    <div class="card bg-light mb-4 mt-4">
        <div class="card-body">
            <?php $session = session() ?>
            <?php $validation = \Config\Services::validation() ?>
            <form action="<?= route_to('/profile'); ?>" method="post" enctype="multipart/form-data">
                <input name="foto_profile" type="file" id="upload" accept=".png, .jpg, .jpeg" hidden />
                <div class="mb-3">
                    <label for="inputNamaLengkap" class="form-label">Nama Lengkap</label>
                    <input type="text"
                        class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : '' ?>"
                        id="inputNamaLengkap" name="nama_lengkap"
                        value="<?= (isset($dataUser)) ? $dataUser['nama_lengkap'] : '', set_value('nama_lengkap') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_lengkap'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputNimNis" class="form-label">NIM / NIS</label>
                    <input type="number"
                        class="form-control <?= ($validation->hasError('nim_nis')) ? 'is-invalid' : '' ?>"
                        id="inputNimNis" name="nim_nis"
                        value="<?= (isset($dataUser)) ? $dataUser['nim_nis'] : '', set_value('nim_nis') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nim_nis'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text"
                        class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                        id="inputUsername" name="username"
                        value="<?= (isset($dataUser)) ? $dataUser['username'] : '', set_value('username') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="text"
                        class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                        id="inputPassword" name="password"
                        value="<?= (isset($dataUser)) ? $dataUser['password'] : '', set_value('password') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" id="inputJenisKelamin" name="gender"
                        value="<?= (isset($dataUser)) ? $dataUser['jenis_kelamin'] : '', set_value('gender') ?>"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="inputNoHP" class="form-label">No. Telepon</label>
                    <input type="number"
                        class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ?>" id="inputNoHP"
                        name="no_hp" value="<?= (isset($dataUser)) ? $dataUser['no_hp'] : '', set_value('no_hp') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_hp'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                        id="inputEmail" name="email"
                        value="<?= (isset($dataUser)) ? $dataUser['email'] : '', set_value('email') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputInstansi" class="form-label">Instansi Pendidikan</label>
                    <input type="text" class="form-control" id="inputInstansi" name="instansi"
                        value="<?= (isset($dataUser)) ? $dataUser['instansi_pendidikan'] : '', set_value('instansi') ?> "
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="inputNamaInstansi" class="form-label">Nama Instansi</label>
                    <input type="text"
                        class="form-control <?= ($validation->hasError('nama_instansi')) ? 'is-invalid' : '' ?>"
                        id="inputNamaInstansi" name="nama_instansi"
                        value="<?= (isset($dataUser)) ? $dataUser['nama_instansi'] : '', set_value('nama_instansi') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_instansi'); ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <input type="submit" value="Simpan" name="submit" class="btn btn-warning col-lg-1">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end container-fluid -->

</div>
<!-- End of Main Content -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Choese image
    let display = document.getElementById("display_image");
    let display_c = document.querySelector("#display_c");
    let input = document.getElementById("upload");
    let img = document.getElementById("logo");

    input.addEventListener("change", () => {
        let reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.addEventListener("load", () => {
            img.remove();
            display.innerHTML =
                `<img src=${reader.result} alt='' id="display_c" style="width: 150px; height: 150px;"/>`;
        });
    });

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