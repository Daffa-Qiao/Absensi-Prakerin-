<?= $this->extend('User/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<main class="wrapper-content-profile">
    <div class="kontainer-profile">
        <div class="wrapper-profile">
            <div class="profile-body">
                <img src="<?= base_url('uploadFoto' . '/' . $namaFile) ?>" alt="" onclick="tampilkanPopup('<?= base_url('uploadFoto' . '/' . $namaFile) ?>')" />
            </div>
        </div>
    </div>
    <div class="wrapper-identity-profile">
        <form action="">
            <div class="identitas-profile">
                <label for="nama">Full Name : </label>
                <input type="text" name="nama_lengkap" id="nama" readonly value="<?= session()->get('member_nama_lengkap') ?>" />
            </div>
            <div class="identitas-profile">
                <label for="nis">NIM/NIS : </label>
                <input type="text" name="" id="" value="<?= session()->get('member_nim_nis') ?>" readonly />
            </div>
            <div class="identitas-profile">
                <label for="username">Username : </label>
                <input type="text" name="" id="" value="<?= session()->get('member_username') ?>" readonly />
            </div>
            <div class="identitas-profile">
                <label for="jenis-kelamin">Gender : </label>
                <input type="text" name="jenis_kelamin" value="<?= session()->get('member_jenis_kelamin') ?>" readonly>
            </div>
            <div class="identitas-profile">
                <label for="telepon">Phone Number :</label>
                <input type="tel" name="no_hp" id="" value="<?= session()->get('member_no_hp') ?>" readonly />
            </div>
            <div class="identitas-profile">
                <label for="email">Email :</label>
                <input type="email" name="" id="" value="<?= session()->get('member_email') ?>" readonly />
            </div>
            <div class="identitas-profileInstansi" id="instansi">
                <div class="instansiAsal">
                    <label for="Instansi">Educational Institutions :</label>
                    <input type="text" name="instansi" value="<?= session()->get('member_instansi') ?>" readonly>
                </div>
                <div class="instansiNama">
                    <label for="namaInstansi">Educational Institutions Name :</label>
                    <input type="text" name="nama_instansi" id="" value="<?= session()->get('member_nama_instansi') ?>" readonly />
                </div>
            </div>
            <div class="identitas-profile">
                <label for="guru_pembimbing">Name Of Supervising Teacher :</label>
                <input type="text" name="nama_pembimbing" id="nama_pembimbing" value="<?= session()->get('member_nama_pembimbing') ?>" readonly />
            </div>
            <div class="identitas-profile">
                <label for="guru_pembimbing">Teacher Phone Number :</label>
                <input type="text" name="nama_pembimbing" id="nama_pembimbing" value="<?= session()->get('member_nama_pembimbing') ?>" readonly />
            </div>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')) : ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon'); ?>',
                title: '<?= session()->getFlashdata('swal_title'); ?>',
            })
        <?php endif; ?>
    </script>
</main>

<?= $this->endSection(); ?>