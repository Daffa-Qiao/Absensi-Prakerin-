<!DOCTYPE html>
<html lang="en"  data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
    <title>
        <?= $halaman ?>
    </title>
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/themeSelector.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/sidebar.css" />
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/my-profile.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/attendance.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/permission.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/history.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/activity.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/setting.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
    </script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://kit.fontawesome.com/fb6ebd8b45.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto+Condensed&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            font-family: "Poppins", sans-serif;
            /* background-color: var(--bs-body-bg); */
        }
        .theme{
            color:var(--text-color);
            font-size: 16px;
        }
        .theme-selector .down,
        .theme-selector .up {
            margin-left: 170px;
        }

        .theme-colors {
            display: flex;
            justify-content: space-around;
            padding: 10px;
        }

        .theme-colors .color {
            width: 31px;
            height: 27px;
            border-radius: 10%;
            cursor: pointer;
            border: 2px solid transparent;
        }
        td .status {
            border-radius: 1rem;
            padding: .4rem 0;
        }

        td .status.hadir {
            background-color: #86e49d;
            color: black;
        }

        td .status.izin {
            background-color: #f6c23e;
            color: white;
        }

        td .status.sakit {
            background-color: #d893a3;
            color: black;
        }

        td .status.alpa {
            background-color: red;
            color: black;
        }

        td .status.baik {
            background-color: #00FF7F;
            border-radius: 1rem;
            padding: .4rem 0;
        }

        td .status.teguran-lisan {
            background-color: #FFFF00;
            color: black;
        }

        td .status.teguran-tertulis {
            background-color: #FF8F00;
            color: black;
        }

        td .status.terminated {
            background-color: #E53636;
            color: black;
        }
        td .status.proses {
            background-color: #FF8F00;
            color: black;
        }
        td .status.selesai {
            background-color: #E53636;
            color: black;
        }

        .theme-colors .color.blue {
            background-color: #01A2EC;
        }

        .theme-colors .color.green {
            background-color: #81A263;
        }


        .theme-colors .color.orange {
            background-color: #ECB159;
        }

        .theme-colors .color.pink {
            background-color: #FA7070;
        }
    </style>
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
                        <li class="nav-link" id="<?= (isset($aktif_activity)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/activity') ?>"> Activity Form</a>
                        </li>
                        <li class="nav-link" id="<?= (isset($aktif_permission)) ? 'aktif' : '' ?>">
                            <a href="<?= site_url('user/permission') ?>"> Permission Form</a>
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
                    <!-- color theme selector start -->
                    <div class="wrapper-a theme-selector" id="themeToggle">
                        <span class="theme">Theme</span>
                        <div class="down" style="display: none;"><i class="bi bi-chevron-down"></i></div>
                        <div class="up"><i class="bi bi-chevron-up"></i></div>
                    </div>
                    <div class="toggle-wrap"></div>
                    <div class="theme-colors" style="display: none;">
                        <div class="color blue" data-bs-theme-value="blue" style="background-color: #00A2E9;"></div>
                        <div class="color green" data-bs-theme-value="green" style="background-color: #81A263;"></div>
                        <div class="color orange" data-bs-theme-value="orange"></div>
                        <div class="color pink" data-bs-theme-value="pink"></div>
                    </div>
                    <!-- color theme selector end -->
                    <a class="wrapper-logout" href="<?= site_url('user/logout') ?>">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
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

    // theme selector
    document.addEventListener('DOMContentLoaded', function() {
    var themeToggle = document.getElementById('themeToggle');
    var themeColors = document.querySelector('.theme-colors');
    var chevronUp = document.querySelector('.theme-selector .up');
    var chevronDown = document.querySelector('.theme-selector .down');

    // Toggle the display of the theme colors
    themeToggle.addEventListener('click', function() {
        if (themeColors.style.display === 'none' || themeColors.style.display === '') {
            themeColors.style.display = 'flex';
            chevronUp.style.display = 'none';
            chevronDown.style.display = 'block';
        } else {
            themeColors.style.display = 'none';
            chevronUp.style.display = 'block';
            chevronDown.style.display = 'none';
        }
    });

    // Add event listeners to the color divs
    var colors = document.querySelectorAll('.theme-colors .color');
    colors.forEach(function(colorDiv) {
        colorDiv.addEventListener('click', function() {
            var selectedColor = colorDiv.getAttribute('data-color');
            document.body.style.backgroundColor = selectedColor;
        });
    });
});

// theme by bootstrap
(() => {
'use strict'

const getStoredTheme = () => localStorage.getItem('theme');
const setStoredTheme = theme => localStorage.setItem('theme', theme);

const getPreferredTheme = () => {
  const storedTheme = getStoredTheme();
  if (storedTheme) {
    return storedTheme;
  }
  return 'blue'; 
}

const setTheme = theme => {
  const themeColors = {
    blue: 'linear-gradient(181deg, #01A2EB 85%, #99D9F5 100%)',
    green: 'linear-gradient(181deg, #81A263 85%, #308E73 100%)',
    orange: 'linear-gradient(181deg, #ECB159 85%, #B77452 100%)',
    pink: 'linear-gradient(181deg, #FA7070 85%, #D9D9D9 100%)'
  }
  const textColors = {
    blue: '#00a2e9', 
    green: '#81A263', 
    orange: '#ECB159', 
    pink: '#FA7070'
  };

  if (themeColors[theme]) {
    document.documentElement.style.setProperty('--bs-body-bg', themeColors[theme]);
    document.body.style.backgroundColor = themeColors[theme];
    document.documentElement.style.setProperty('--text-color', textColors[theme]);
  }
}

setTheme(getPreferredTheme());

window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
    toggle.addEventListener('click', () => {
      const theme = toggle.getAttribute('data-bs-theme-value');
      setStoredTheme(theme);  
      setTheme(theme); 
    });
  });
});
})();


</script>

</html>