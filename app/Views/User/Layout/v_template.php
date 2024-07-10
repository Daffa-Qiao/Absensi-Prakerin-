<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
    <title>
        <?= $halaman ?>
    </title>
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/sidebar.css" />
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/my-profile.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/attendance.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/permission.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/history.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/activity.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/setting.css"><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
    </script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://kit.fontawesome.com/fb6ebd8b45.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto+Condensed&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="kontainer">
    <div id="wrapper">
        <!-- Sidebar -->
        <nav class="navigasi">
            <div class="wrapperNav">
                <header>
                    <div class="text">
                        <h1 class="nama-lengkap">
                            <?= session()->get('member_username') ?>
                        </h1>
                        <h2 class="sekolah">
                            <?= session()->get('member_nama_instansi') ?>
                        </h2>
                    </div>
                </header>
                <main>
                    <ul class="menu-links">
                        <li class="nav-link" id="<?= (isset($aktif_profile)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/my-profile') ?>"> My Profile </a>
                        </li>
                        <li class="nav-link" id="<?= (isset($aktif_attendance)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/attendance') ?>"> Attendance Form </a>
                        </li>
                        <li class="nav-link" id="<?= (isset($aktif_permission)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/permission') ?>"> Permission Form</a>
                        </li>
                        <li class="nav-link" id="<?= (isset($aktif_activity)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/activity') ?>"> Activity Form</a>
                        </li>
                        <li class="nav-link" id="<?= (isset($aktif_history)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/historyAttendace') ?>"> History Attendance </a>
                        </li>
                        <li class="nav-link" id="<?= (isset($aktif_history_activity)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/historyActivity') ?>"> History Activity </a>
                        </li>
                        <li class="nav-link" id="<?= (isset($aktif_setting)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/setting') ?>"> Settings & Privacy </a>
                        </li>
                    </ul>
                </main>
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
                    <div class="user-text <?= (strlen(session()->get('member_nama_lengkap')) > 15) ? 'long-name' : '' ?>">
                        <?= session()->get('member_nama_lengkap') ?>
                    </div>
                    <div class="user-profile">
                        <img src="<?= base_url('uploadFoto' . '/' . $namaFile) ?>" id="logoutMenu" />
                    </div>
                </div>
                <div class="dropdownMenu" id="myModal">
                    <div class="wrapper-user">
                        <img src="<?= base_url('uploadFoto' . '/' . $namaFile) ?>" alt="" />
                        <div class="userText">
                            <?= session()->get('member_username') ?>
                        </div>
                    </div>
                    <div class="wrapper-a">
                        <a href="<?= site_url('user/my-profile'); ?>">See Profile</a>
                    </div>
                    <?php if (session('redirected') == 'admin' or session('redirected') == 'superadmin') : ?>
                        <div class="wrapper-a">
                            <a href="<?= site_url('admin/dashboard'); ?>">Admin Page</a>
                        </div>
                    <?php endif ?>
                    <a class="wrapper-logout" href="<?= site_url('user/logout') ?>">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar</span>
                    </a>
                </div>
            </header>
            <header class="second">
                <div class="text">
                    <?= $title ?>
                </div>
            </header>
            <!-- Template Main Content -->
            <?= $this->renderSection('content') ?>
            <!-- End of Template Main Content -->

        </main>
    </div>

    <div id="popup" class="popup">
        <img id="gambar" src="" alt="Preview">
    </div>
</body>
<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    <?php if (session()->getFlashdata('swal_icon3')) : ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon3'); ?>',
            html: '<h2><?= session()->getFlashdata('swal_text3'); ?></h2>',
            title: '<?= session()->getFlashdata('swal_title3'); ?>',
            showConfirmButton: false,
            timer: 2000
        })
    <?php endif; ?>
    <?php if (session()->getFlashdata('swal_icon')) : ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
        })
    <?php endif; ?>

    function tampilkanPopup(sumberGambar) {
        var popup = document.getElementById('popup');
        var gambarPopup = popup.querySelector('img');
        var wrapper = document.getElementById('wrapper');

        gambarPopup.src = sumberGambar;

        popup.style.display = "flex";
        wrapper.style.filter = "blur(8px)";
    }

    function sembunyikanPopup() {
        var popup = document.getElementById('popup');
        var wrapper = document.getElementById('wrapper');

        popup.style.display = "none";
        wrapper.style.filter = "none";
    }
    document.getElementById('popup').onclick = sembunyikanPopup;
    // dropdown
    const menu = document.querySelector(".wrapper-icon i");
    const nav = document.querySelector("nav");
    menu.addEventListener("click", () => {
        nav.classList.toggle("close");
    });

    document.addEventListener("click", function(event) {
        if (nav.contains(event.target)) {
            nav.contains.remove("close")
        } else if (!menu.contains(event.target)) {
            nav.classList.remove("close");
        }
    })
    const img = document.querySelector(".user-profile img");
    const modal = document.getElementById("myModal")

    img.addEventListener("click", () => {
        modal.classList.toggle("active")
    })

    document.addEventListener("click", function(event) {
        if (!img.contains(event.target) && !modal.contains(event.target)) {
            modal.classList.remove("active");
        }
    });

</script>

</html>