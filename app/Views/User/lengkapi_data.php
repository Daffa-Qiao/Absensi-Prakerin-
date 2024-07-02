<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        User | Create Account
    </title>
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/sidebar.css" />
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/index.css">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://kit.fontawesome.com/fb6ebd8b45.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto+Condensed&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body class="kontainer">
    <!-- Sidebar -->
    <nav class="navigasi">
        <div class="wrapperNav">
            <header>
                <div class="text">
                    <h1 class="nama-lengkap">
                        (Nama Lengkap)
                    </h1>
                    <h2 class="sekolah">
                        (Nama Instansi)
                    </h2>
                </div>
            </header>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="kontainer-content">
        <?php $namaFile = session()->get('member_foto') ?>
        <div class="wrapper-icon">
            <i class="bx bx-menu"></i>
        </div>
        <header class="first">
            <div class="wrapper-name">
                <div class="user-text">
                    Username
                </div>
                <div class="user-profile">
                    <img src="<?= base_url('uploadFoto/' . 'profile.png') ?>" />
                </div>
            </div>
        </header>
        <header class="second">
            <div class="text">
                Create Account
            </div>
        </header>
        <!-- Template Main Content -->
        <main class="wrapper-content-profile">
            <div class="kontainer-profile">
                <div class="wrapper-profile">
                    <div class="profile-body">
                        <div class="display_image">
                            <div class="tampil" id="display_image"></div>
                            <img src="<?= base_url('uploadFoto/profile.png'); ?>" id="base_img">
                        </div>
                    </div>
                    <div class="text btn">
                        <label for="upload" class="uploud-image bg-primary bg-gradient">Pilih Gambar</label>
                    </div>
                </div>
            </div>
            <div class="wrapper-identity-profile">
                <?php $validation = \Config\Services::validation() ?>
                <form action="<?= route_to('/index') ?>" method="post" enctype="multipart/form-data">
                    <!-- Untuk input file foto  -->
                    <input name="profile" type="file" id="upload" accept=".png, .jpg, .jpeg" hidden />
                    <div class="identitas-profile">
                        <label for="nama_lengkap">Nama Lengkap : </label>
                        <input type="text" name="nama_lengkap"
                            class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>"
                            id="" value="<?= set_value('nama_lengkap') ?>" required />
                        <div class="invalid-feedbak">
                            <?= $validation->getError('nama_lengkap') ?>
                        </div>
                    </div>
                    <div class="identitas-profile">
                        <label for="nim/nis">NIM/NIS : </label>
                        <input type="number" name="nim_nis" id="nim_nis"
                            class="form-control <?= ($validation->hasError('nim_nis')) ? 'is-invalid' : ''; ?>"
                            value="<?= set_value('nim_nis') ?>" required />
                        <div class="invalid-feedbak">
                            <?= $validation->getError('nim_nis') ?>
                        </div>
                    </div>
                    <div class="identitas-profile">
                        <label for="username">Username : </label>
                        <input type="text" name="username" id="" value="<?= session()->get('akun_username'); ?>"
                            readonly />
                    </div>
                    <div class="identitas-profile">
                        <label for="gender">Jenis Kelamin : </label>
                        <select name="gender" id="gender"
                            class="form-select <?= ($validation->hasError('gender')) ? 'is-invalid' : ''; ?>"
                            value="<?= set_value('selected_gender') ?>" required>
                            <option value="" hidden></option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        <div class="invalid-feedbak">
                            <?= $validation->getError('gender') ?>
                        </div>
                    </div>
                    <div class="identitas-profile">
                        <label for="no_hp">No. Telepon :</label>
                        <input type="number" name="no_hp" id="" pattern="[0-9]{4}[0-9]{4}[0-9]{5}"
                            class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>"
                            value="<?= set_value('no_hp') ?>" placeholder="08xxxxx" required />
                        <div class="invalid-feedbak">
                            <?= $validation->getError('no_hp') ?>
                        </div>
                    </div>
                    <div class="identitas-profile">
                        <label for="email">Email :</label>
                        <input type="email" name="email" id="" value="<?= session()->get('member_email'); ?>"
                            readonly />
                    </div>
                    <div class="identitas-profileInstansi">
                        <div class="instansiAsal">
                            <label for="instansiSelect">Instansi Pendidikan :</label>
                            <select name="instansi" id="instansi"
                                class="form-select <?= ($validation->hasError('instansi')) ? 'is-invalid' : ''; ?>"
                                onchange="autoFill()" style="border: none;" required>
                                <option value="" hidden></option>
                                <option value="Sekolah">Sekolah</option>
                                <option value="Universitas">Universitas</option>
                            </select>
                            <div class="invalid-feedbak">
                                <?= $validation->getError('instansi') ?>
                            </div>
                        </div>
                        <div class="instansiNama">
                            <label for="nama_instansi">Nama Instansi :</label>
                            <input type="text" name="nama_instansi" id="namaInstansi"
                                class="form-control <?= ($validation->hasError('nama_instansi')) ? 'is-invalid' : ''; ?>"
                                value="<?= set_value('nama_instansi') ?>" required />
                            <div class="invalid-feedbak">
                                <?= $validation->getError('nama_instansi') ?>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-submit ">
                        <button class="submit btn btn-success bg-gradient" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </main>
        <!-- End of Template Main Content -->
    </main>
    <!-- JS -->

    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('swal_icon2')): ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon2'); ?>',
                text: '<?= session()->getFlashdata('swal_text2'); ?>',
            })
        <?php endif; ?>

        // Choese image
        let display = document.getElementById("display_image");
        let display_h = document.getElementById("display_image_h");
        let input = document.querySelector("#upload");
        let display_c = document.querySelector("#display_c");
        let base_img = document.getElementById("base_img");

        input.addEventListener("change", () => {
            let reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.addEventListener("load", () => {
                base_img.remove();
                display.innerHTML = `<img src=${reader.result} alt='' width="200px"" id="display_c"/>`;
            });
        });

        const menu = document.querySelector(".wrapper-icon i");
        const nav = document.querySelector("nav");

        menu.addEventListener("click", () => {
            nav.classList.toggle("close");
        });

        document.addEventListener("click", function (event) {
            if (nav.contains(event.target)) {
                nav.contains.remove("close")
            } else if (!menu.contains(event.target)) {
                nav.classList.remove("close");
            }
        })

        function autoFill() {
            var instansi = document.getElementById("instansi").value;
            var namaInstansi = document.getElementById("namaInstansi");

            if (instansi == "Sekolah") {
                namaInstansi.value = "SMK";
            } else if (instansi == "Universitas") {
                namaInstansi.value = "UNIVERSITAS";
            }
        }
    </script>
</body>

</html>