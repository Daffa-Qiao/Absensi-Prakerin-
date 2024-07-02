<?= $this->extend('User/Layout/v_template'); ?>

<?= $this->section('content'); ?>

<head>
    <style>
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus{
            box-shadow: none;
            outline: 0 none;
        }
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        span.mata{
            cursor: pointer;
        }
    </style>
</head>

<main class="wrapper-content-setting">
    <?php $namaFile = session()->get('member_foto') ?>
    <?php $validation = \Config\Services::validation() ?>
    <div class="kontainer-profile">
        <div class="wrapper-profile-setting">
            <div class="profile-body">
                <div class="display_image">
                    <div class="tampil" id="display_image"></div>
                    <img id="base_img" src="<?= base_url('uploadFoto/profile.png'); ?>"></img>
                </div>
            </div>
            <div class="text">
                <label for="upload" class="uploud-image bg-primary bg-gradient">Pilih Gambar</label>
            </div>
        </div>
    </div>
    <div class="wrapper-identity-setting">
        <form action="<?= route_to('/setting'); ?>" method="post" enctype="multipart/form-data">
            <input name="foto_profile" type="file" id="upload" accept=".png, .jpg, .jpeg" hidden
                value="<?= set_value('foto_profile'); ?>" />
            <div class="identitas-setting">
                <label for="email">Email : </label>
                <input type="email" name="email" id="email"
                    class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                    value="<?= (isset($email)) ? $email : '', set_value('email') ?>" />
                <div class="invalid-feedbak">
                    <h3>
                        <?= ($validation->getError('email')); ?>
                    </h3>
                </div>
            </div>

            <div class="identitas-setting">
                <label for="username">Username : </label>
                <input type="text" name="username" id="username"
                    class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                    value="<?= (isset($username)) ? $username : '', set_value('username') ?>" />
                <div class="invalid-feedbak">
                    <h3>
                        <?= ($validation->getError('username')); ?>
                    </h3>
                </div>
            </div>
            <div class="identitas-setting">
                <label for="password_old">Current Password : </label>
                <div class="wrapperInput d-flex align-items-center bg-white" style="z-index: -1; padding-right: 10px; border-radius: 5px;">
                    <input type="password" name="password_old" id="password_old"
                        class="form-control <?= ($validation->hasError('password_old')) ? 'is-invalid' : '' ?>" style=""/>
                        <span id="wrapperMata" class="mata">
                            <i class="fa-regular fa-eye fa-xl"></i>
                        </span>
                </div>
                <div class="invalid-feedbak">
                    <h3>
                        <?= ($validation->getError('password_old')); ?>
                    </h3>
                </div>
            </div>
            <div class="identitas-setting">
                <label for="password_new">New Password : </label>
                <div class="wrapperInputDua d-flex align-items-center bg-white" style="z-index: -1; padding-right: 10px; border-radius: 5px;">
                    <input type="password" name="password_new" id="password_new"
                        class="form-control <?= ($validation->hasError('password_new')) ?>"
                        value="<?= set_value('password_new'); ?>" />
                        <span id="wrapperMataDua" class="mata">
                            <i class="fa-regular fa-eye fa-xl"></i>
                        </span>
                </div>
                <div class="invalid-feedbak">
                    <h3>
                        <?= ($validation->getError('password_new')); ?>
                    </h3>
                </div>
            </div>
            <div class="identitas-setting">
                <label for="konfirmasi_password_new ">Repeat New Password:</label>
                <div class="wrapperInputTiga d-flex align-items-center bg-white" style="z-index: -1; padding-right: 10px; border-radius: 5px;">
                    <input type="password" name="konfirmasi_password_new" id="konfirmasi_password_new"
                        class="form-control <?= ($validation->hasError('konfirmasi_password_new')) ?>" />
                        <span id="wrapperMataTiga" class="mata">
                            <i class="fa-regular fa-eye fa-xl"></i>
                        </span>
                </div>
                <div class="invalid-feedbak">
                    <h3>
                        <?= ($validation->getError('konfirmasi_password_new')); ?>
                    </h3>
                </div>
            </div>
            <input type="submit" name="submit" value="Save" class="button"
                style="background-color: #198754; color: #fff;">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if ($validation->getError('foto_profile')): ?>
            Swal.fire({
                icon: 'error',
                title: '<?= $validation->getError('foto_profile'); ?>',
            })
        <?php endif; ?>
        <?php if (session()->getFlashdata('swal_icon')): ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon'); ?>',
                title: '<?= session()->getFlashdata('swal_title'); ?>',
            })
        <?php endif; ?>

        // Choese image
        let display = document.getElementById("display_image");
        let display_h = document.getElementById("display_image_h");
        let input = document.querySelector("#upload");
        let submit = document.getElementsByClassName("submit");
        let display_c = document.querySelector("#display_c");
        let base_img = document.getElementById('base_img');

        input.addEventListener("change", () => {
            let reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.addEventListener("load", () => {
                base_img.remove();
                display.innerHTML =
                    `<img src=${reader.result} style="width: 150px; height: 150px;" id="display_c"/>`;
            });
        });

        // show password
        let wrapperMata =document.getElementById("wrapperMata")
        wrapperMata.addEventListener("click", function() {
            let pw = document.querySelector("input#password_old")
            let wrapperPw =document.getElementById("wrapperInput")
            if (pw.type === "password") {
                pw.type = "text";
                wrapperMata.innerHTML = `<i class="fa-regular fa-eye-slash fa-xl" style"z-index:2;"></i>`;
                wrapperMata.style.translate = "1px";
            } else {
                pw.type = "password";
                wrapperMata.innerHTML = `<i class="fa-regular fa-eye fa-xl" style"z-index:2;"></i>`;
                wrapperMata.style.translate = "-.5px";
            }
        });

        let wrapperMataD =document.getElementById("wrapperMataDua")
        wrapperMataD.addEventListener("click", function() {
            let pw = document.querySelector("input#password_new")
            let wrapperPwD =document.getElementById("wrapperInputDua")
            if (pw.type === "password") {
                pw.type = "text";
                wrapperMataD.innerHTML = `<i class="fa-regular fa-eye-slash fa-xl" style"z-index:2;"></i>`;
                wrapperMataD.style.translate = "1px";
            } else {
                pw.type = "password";
                wrapperMataD.innerHTML = `<i class="fa-regular fa-eye fa-xl" style"z-index:2;"></i>`;
                wrapperMataD.style.translate = "-.5px";
            }
        });

        let wrapperMataT =document.getElementById("wrapperMataTiga")
        wrapperMataT.addEventListener("click", function() {
            let pw = document.querySelector("input#konfirmasi_password_new")
            let wrapperPwT =document.getElementById("wrapperInputTiga")
            if (pw.type === "password") {
                pw.type = "text";
                wrapperMataT.innerHTML = `<i class="fa-regular fa-eye-slash fa-xl" style"z-index:2;"></i>`;
                wrapperMataT.style.translate = "1px";
            } else {
                pw.type = "password";
                wrapperMataT.innerHTML = `<i class="fa-regular fa-eye fa-xl" style"z-index:2;"></i>`;
                wrapperMataT.style.translate = "-.5px";
            }
        });
    </script>
</main>
<?= $this->endSection(); ?>