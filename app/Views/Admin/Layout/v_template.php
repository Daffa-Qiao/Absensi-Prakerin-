<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>
        <?= $halaman; ?>
    </title>

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.jqueryui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.jqueryui.css" />
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/dashboard.css" />
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/fb6ebd8b45.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('admin'); ?>/css/sb-admin-2.min.css" rel="stylesheet" />
    <!-- Custom styles for this page -->
    <link href="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/rekap.css" />


    <style>
        * {
            font-family: "Poppins", sans-serif;
        }
        .custom-sidebar {
            width: 290px !important;
        }

        .custom-sidebar .nav-item {
            width: 100%;
        }

        .custom-sidebar .nav-link {
            white-space: nowrap;
            overflow: hidden;

        }

        img.instansi {
            width: 50px;
            height: 50px;
            border-radius: 25%;
            vertical-align: middle;
            cursor: pointer;
        }

        .title {
            height: 80px;
            display: flex;
            align-items: center;
            font-size: 24px;
            background-color: #e5e5e5;
        }

        .wrapperCard {
            background-color: #F5F5F5;
            height: 100%;
        }

        .wrapperP {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 140px;
        }

        .wrapperP p {
            border-bottom: solid 2px;
        }

        .wrapperImg {
            border: solid;
            background-color: gray;
        }

        #display_c {
            width: 100px;
            height: 100px;
        }

        li.nav-item>#collapseUtilities>.bg-white a.ssw:hover {
            background-color: #f6c23e;
            background-image: linear-gradient(180deg, #f6c23e 10%, #dda20a 100%);
            color: white !important;
            transition: .2s;
        }

        li.nav-item>#collapseUtilities>.bg-white a.mhs:hover {
            background-color: #36b9cc;
            background-image: linear-gradient(180deg, #36b9cc 10%, #258391 100%);
            color: white !important;
            transition: .2s;
        }

        li.nav-item>#collapseTwo>.bg-white a.ssw:hover {
            background-color: #f6c23e;
            background-image: linear-gradient(180deg, #f6c23e 10%, #dda20a 100%);
            color: white !important;
            transition: .2s;
        }

        li.nav-item>#collapseTwo>.bg-white a.mhs:hover {
            background-color: #36b9cc;
            background-image: linear-gradient(180deg, #36b9cc 10%, #258391 100%);
            color: white !important;
            transition: .2s;
        }

        li.nav-item>#collapseOne>.bg-white a.ssw:hover {
            background-color: #f6c23e;
            background-image: linear-gradient(180deg, #f6c23e 10%, #dda20a 100%);
            color: white !important;
            transition: .2s;
        }

        li.nav-item>#collapseOne>.bg-white a.mhs:hover {
            background-color: #36b9cc;
            background-image: linear-gradient(180deg, #36b9cc 10%, #258391 100%);
            color: white !important;
            transition: .2s;
        }

        li.nav-item>#collapseThree>.bg-white a.ssw:hover {
            background-color: #f6c23e;
            background-image: linear-gradient(180deg, #f6c23e 10%, #dda20a 100%);
            color: white !important;
            transition: .2s;
        }

        li.nav-item>#collapseThree>.bg-white a.mhs:hover {
            background-color: #36b9cc;
            background-image: linear-gradient(180deg, #36b9cc 10%, #258391 100%);
            color: white !important;
            transition: .2s;
        }

        .headerImg {
            width: 55px;
            height: 55px;
            border-radius: 100px;
            border: 2px solid black;
        }

        .wrapper-profile {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-top: 3rem;
        }

        .wrapper-profile .profile-body {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            box-shadow: 1px 10px 10px 2px black;
            height: 200px;
            width: 220px;
        }

        .wrapper-profile .profile-body img {
            height: 150px;
            width: 150px;
            border: 2px solid black;
            border-radius: 100px;
            cursor: pointer;
        }

        table.table {
            border-bottom: 1px solid black !important;
        }

        #dTable_paginate {
            border: 2px solid black;
            padding: 0;
        }

        #dTable_paginate span>* {
            border-right: .0 1px solid black;
            margin: 0;
        }

        #dTable_paginate span>*:nth-child(1) {
            border-left: .01px solid black;
            margin: 0;
        }

        #dTable_wrapper .dt-buttons {
            display: none;
        }

        thead.border tr th {
            border: 1px solid black;
            color: black;
        }

        thead.border tr th:nth-child(1) {
            border-left: 1px solid black;
        }

        tbody.border tr td:nth-child(n) {
            border-color: black;
            border-style: solid;
            color: black;
        }

        tbody.border tr td:nth-child(1) {
            border-left: 1px solid black;
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
            color: black;
        }

        td .status.sakit {
            background-color: #d893a3;
            color: black;
        }

        @media screen and (max-width: 576px) {
            #box {
                width: 90%;
            }
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion custom-sidebar" id="accordionSidebar" style="height: 100vh; position: sticky; top: 0; right: 0; z-index: 1;">
            <!-- Sidebar - Brand -->
            <a class="ml-10 sidebar-brand d-flex align-items-center justify-content-center" href="#" style="cursor: default;">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>

                <div class="sidebar-brand-text mx-3">
                    <span style="font-size: 17px">
                        <?php if (session('redirected') == 'superadmin') : ?>
                            <?= 'Super Admin'; ?>
                        <?php endif ?>
                        <?php if (session('redirected') == 'admin') : ?>
                            <?= 'Admin'; ?>
                        <?php endif ?>

                        <h6 style="font-size: 8px"> Kementerian Perhubungan</h6>
                    </span>
                </div>

            </a>

            <!-- Divider -->

            <hr class="sidebar-divider my-0" />


            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= (isset($aktif_dashboard)) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/dashboard'); ?>" style="width:270px !important">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->

            <!-- Heading -->

            <li class="nav-item <?= (isset($aktif_dataAbsen)) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/data-absen'); ?>" style="width: 270px !important">
                    <i class="bi bi-pencil-square"></i>
                    <span>Attendance Data</span></a>
            </li>

            <!-- <li class="nav-item <?= (isset($aktif_dataLaporan)) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/data-laporan'); ?>" style="width: 270px !important">
                    <i class="fa-regular fa-clipboard" aria-hidden="true"></i>
                    <span>Report Data</span></a>
            </li> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= (isset($aktif_dataUser)) ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="width: 270px !important">
                    <i class="bi bi-person-fill"></i>
                    <span>Data User</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">OPTIONS:</h6>
                        <a class="collapse-item ssw <?= (isset($aktif_dataSiswa)) ? 'active text-warning' : '' ?>" href="<?= site_url('admin/data-siswa'); ?>">Student</a>
                        <a class="collapse-item mhs <?= (isset($aktif_dataMahasiswa)) ? 'active text-info' : '' ?>" href="<?= site_url('admin/data-mahasiswa'); ?>">College Student</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item <?= (isset($aktif_instansi) ? $aktif_instansi : ''); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities" style="width: 270px !important">
                    <i class="bi bi-bank2"></i>
                    <span>Educational Institutions</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">OPTIONS:</h6>
                        <a class="collapse-item ssw <?= (isset($aktif_sekolah) ? 'active text-warning' : ''); ?>" href="<?= site_url('admin/instansi-sekolah'); ?>">High School</a>
                        <a class="collapse-item mhs <?= (isset($aktif_universitas) ? 'active text-info' : ''); ?>" href="<?= site_url('admin/instansi-universitas'); ?>">University</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <li class="nav-item <?= (isset($aktif_rekapAbsensi) ? 'active' : ''); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: 270px !important">
                    <i class="bi bi-card-list"></i>
                    <span>Attendance Recap</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">OPTIONS:</h6>
                        <a class="collapse-item ssw <?= (isset($aktif_rekapSiswa) ? 'active text-warning' : ''); ?>" href="<?= site_url('admin/rekap-siswa'); ?>">Student</a>
                        <a class="collapse-item mhs <?= (isset($aktif_rekapMahasiswa) ? 'active text-info' : ''); ?>" href="<?= site_url('admin/rekap-mahasiswa'); ?>">Collage Student</a>
                    </div>
                </div>

            </li>

            <li class="nav-item <?= (isset($aktif_rekapAktifitas) ? $aktif_rekapAktifitas : ''); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseUtilities" style="width: 270px !important">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Activity Recap</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">OPTIONS:</h6>
                        <a class="collapse-item ssw <?= (isset($aktif_rekapAktifitasSiswa) ? 'active text-warning' : ''); ?>" href="<?= site_url('admin/rekap-aktifitas-siswa'); ?>">Student</a>
                        <a class="collapse-item mhs <?= (isset($aktif_rekapAktifitasMahasiswa) ? 'active text-info' : ''); ?>" href="<?= site_url('admin/rekap-aktifitas-mahasiswa'); ?>">Collage Student</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Tables -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <?php if (session('redirected') == 'superadmin') : ?>
                <li class="nav-item <?= (isset($aktif_superAdmin)) ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('admin/super-admin'); ?>">
                        <i class="fa-solid fa-user-gear"></i>
                        <span>Super Admin</span></a>
                </li>
            <?php endif ?>

            <li class="nav-item <?= (isset($aktif_listSuperAdmin)) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/list-super-admin'); ?>">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>List Super Admin</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar sticky-top shadow h2" style="padding: 38px 10px;">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" aria-hidden="false" id="burger"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center fs-3">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <!-- Counter - Messages -->

                        <br />
                        <br /><br /><br />
                        <span class="mr-2 d-none d-lg-inline small text-dark font-weight-bold" style="cursor: default;">
                            <?= session()->get('member_nama_lengkap'); ?>
                        </span>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <!-- <a class="nav-link dropdown-toggle rounded-circle fas fa-user" href="#" id="userDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                aria-hidden="true">
                            </a> -->
                            <div class="profile" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-hidden="true">
                                <?php $namaFile = session()->get('member_foto') ?>
                                <img src="<?= base_url('uploadFoto/' . $namaFile); ?>" class="headerImg">
                            </div>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= site_url('admin/profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= site_url('user/my-profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                                    User Page
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="logout()">
                                    <i href="" class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <nav class="navbar navbar-light bg-light" style="min-width: 21rem;">
                    <h2 class="mt-3 text-dark font-weight-bold">
                        <?= $title; ?>
                    </h2>
                </nav>
                <!-- End of Topbar -->

                <?= $this->renderSection('content'); ?>

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; 2023</span></span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Preview Image -->
    </div>
    <div id="popup" style="display: none;">
        <img id="gambar" src="" alt="Preview">
    </div>
</body>
<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->


<!-- Custom scripts for all pages-->
<script src="<?= base_url('admin'); ?>/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('admin'); ?>/js/demo/datatables-demo.js"></script>

<!-- js gue -->
<script src="<?= base_url('admin'); ?>/js/modal-tambah.js"></script>
<script src="<?= base_url('admin'); ?>/js/modal-edit.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.jqueryui.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    // LOGOUT SWAL
    function logout() {
        Swal.fire({
            title: "Yakin ingin keluar?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, keluar!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('/logout'); ?>";
            }
        });
    }


    // Preview Image Popup
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
    $('#popup').on("click", function() {
        sembunyikanPopup();
    });
    $('#gambar').on("click", function() {
        var popup = $('#popup').val();

        popup.style.display = "flex"
    });

    // untuk simpan data
    $("#tombolSimpan").on("click", function() {
        var $nama_lengkap = $("#inputNamaLengkap").val();
        var $nim_nis = $("#inputNimNis").val();
        var $username = $("#inputUsername").val();
        var $gender = $("#inputGender").val();
        var $no_hp = $("#inputNoHP").val();
        var $email = $("#inputEmail").val();
        var $instansi = $("#inputInstansi").val();
        var $nama_instansi = $("#inputNamaInstansi").val();
        var $nama_pembimbing = $("#inputNamaPembimbing").val();
        var $no_pembimbing = $("#inputNoPembimbing").val();

        $.ajax({
            url: "<?= site_url('Admin/Modal/tambahUser'); ?>",
            type: "POST",
            data: {
                nama_lengkap: $nama_lengkap,
                nim_nis: $nim_nis,
                username: $username,
                gender: $gender,
                no_hp: $no_hp,
                email: $email,
                instansi: $instansi,
                nama_instansi: $nama_instansi,
                nama_pembimbing: $nama_instansi,
                no_pembimbing: $no_pembimbing,
            },
            success: function(hasil) {
                var $obj = $.parseJSON(hasil);
                // jika ada error
                if ($obj.error) {
                    $(".sukses").hide();

                    if ($obj.error.nama_lengkap) {
                        $("#inputNamaLengkap").addClass("is-invalid");
                        $(".errornama_lengkap").html($obj.error.nama_lengkap);
                    }
                    if ($obj.error.nim_nis) {
                        $("#inputNimNis").addClass("is-invalid");
                        $(".errornim_nis").html($obj.error.nim_nis);
                    }
                    if ($obj.error.username) {
                        $("#inputUsername").addClass("is-invalid");
                        $(".errorusername").html($obj.error.username);
                    }
                    if ($obj.error.gender) {
                        $("#inputGender").addClass("is-invalid");
                        $(".errorgender").html($obj.error.gender);
                    }
                    if ($obj.error.no_hp) {
                        $("#inputNoHP").addClass("is-invalid");
                        $(".errorno_hp").html($obj.error.no_hp);
                    }
                    if ($obj.error.email) {
                        $("#inputEmail").addClass("is-invalid");
                        $(".erroremail").html($obj.error.email);
                    }
                    if ($obj.error.instansi) {
                        $("#inputInstansi").addClass("is-invalid");
                        $(".errorinstansi").html($obj.error.instansi);
                    }
                    if ($obj.error.nama_instansi) {
                        $("#inputNamaInstansi").addClass("is-invalid");
                        $(".errornama_instansi").html($obj.error.nama_instansi);
                    }
                    if ($obj.error.nama_pembimbing) {
                        $("#inputNamaPembimbing").addClass("is-invalid");
                        $(".errornama_pembimbing").html($obj.error.nama_pembimbing);
                    }
                    if ($obj.error.no_pembimbing) {
                        $("#inputNoPembimbing").addClass("is-invalid");
                        $(".errorno_pembimbing").html($obj.error.no_pembimbing);
                    }

                    // value
                } else if ($obj.sukses == true) {
                    /**  jika sukses */
                    refresh();
                }
            },
        });
        hapusValidasi();
    });

    // UNTUK EDIT DATA
    $("#tombolEdit").on("click", function() {
        var $id = $("#inputId").val();
        var $nama_lengkap = $("#editNamaLengkap").val();
        var $nim_nis = $("#editNimNis").val();
        var $username = $("#editUsername").val();
        var $password = $("#editPassword").val();
        var $gender = $("#editGender").val();
        var $no_hp = $("#editNoHP").val();
        var $email = $("#editEmail").val();
        var $instansi = $("#editInstansi").val();
        var $nama_instansi = $("#editNamaInstansi").val();
        var $nama_pembimbing = $("#editNamaPembimbing").val();
        var $no_pembimbing = $("#editNoPembimbing").val();

        $.ajax({
            url: "<?= site_url('Admin/Modal/editUserModal'); ?>",
            type: "POST",
            data: {
                id: $id,
                edit_nama_lengkap: $nama_lengkap,
                edit_nim_nis: $nim_nis,
                edit_username: $username,
                edit_password: $password,
                edit_gender: $gender,
                edit_no_hp: $no_hp,
                edit_email: $email,
                edit_instansi: $instansi,
                edit_nama_instansi: $nama_instansi,
                edit_nama_pembimbing: $nama_pembimbing,
                edit_no_pembimbing: $no_pembimbing,
            },
            dataType: "json",
            success: function(response) {
                // jika ada error
                if (response.error) {
                    $(".sukses").hide();

                    if (response.error.edit_nama_lengkap) {
                        $("#editNamaLengkap").addClass("is-invalid");
                        $(".errorEdit_nama_lengkap").html(response.error.edit_nama_lengkap);
                    }
                    if (response.error.edit_nim_nis) {
                        $("#editNimNis").addClass("is-invalid");
                        $(".errorEdit_nim_nis").html(response.error.edit_nim_nis);
                    }
                    if (response.error.edit_username) {
                        $("#editUsername").addClass("is-invalid");
                        $(".errorEdit_username").html(response.error.edit_username);
                    }
                    if (response.error.edit_password) {
                        $("#editPassword").addClass("is-invalid");
                        $(".errorEdit_password").html(response.error.edit_password);
                    }
                    if (response.error.edit_gender) {
                        $("#editGender").addClass("is-invalid");
                        $(".errorEdit_gender").html(response.error.edit_gender);
                    }
                    if (response.error.edit_no_hp) {
                        $("#editNoHP").addClass("is-invalid");
                        $(".errorEdit_no_hp").html(response.error.edit_no_hp);
                    }
                    if (response.error.edit_email) {
                        $("#editEmail").addClass("is-invalid");
                        $(".errorEdit_email").html(response.error.edit_email);
                    }
                    if (response.error.edit_instansi) {
                        $("#editInstansi").addClass("is-invalid");
                        $(".errorEdit_instansi").html(response.error.edit_instansi);
                    }
                    if (response.error.edit_nama_pembimbing) {
                        $("#editNamaPembimbing").addClass("is-invalid");
                        $(".errorEdit_nama_pembimbing").html(response.error.edit_nama_pembimbing);
                    }
                    if (response.error.edit_no_pembimbing) {
                        $("#editNoPembimbing").addClass("is-invalid");
                        $(".errorEdit_no_pembimbing").html(response.error.edit_no_pembimbing);
                    }
                    // value
                } else if (response.sukses == true) {
                    /**  jika sukses */
                    refresh();
                }
            }
        });
        hapusValidasiEdit();
    });

    function hapus($id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('Admin/Modal/hapus') ?>/" + $id;
            }
        });
    }

    function edit($id) {
        $.ajax({
            url: "<?= site_url('Admin/Modal/editUser') ?>/" + $id,
            type: "GET",
            success: function(hasil) {
                var $obj = $.parseJSON(hasil);
                if ($obj.id != "") {
                    $("#inputId").val($obj.member_id);
                    $("#editNamaLengkap").val($obj.nama_lengkap);
                    $("#editNimNis").val($obj.nim_nis);
                    $("#editUsername").val($obj.username);
                    $("#editPassword").val($obj.password);
                    $("#editGender").val($obj.jenis_kelamin);
                    $("#editNoHP").val($obj.no_hp);
                    $("#editEmail").val($obj.email);
                    $("#editInstansi").val($obj.instansi_pendidikan);
                    $("#editNamaInstansi").val($obj.nama_instansi);
                    $("#editNamaPembimbing").val($obj.nama_pembimbing);
                    $("#editNoPembimbing").val($obj.no_pembimbing);
                }
            },
        });
    }

    function get_sekolah($id) {
        $.ajax({
            url: "<?= site_url('Admin/Modal/instansi'); ?>/" + $id,
            type: "GET",
            dataType: "json",
            success: function(response) {
                $('#instansiNama').val(response.namaInstansi);
                $('#instansiJumlah').val(response.jumlahSiswa);
                $('#instansiPendidikan').val(response.instansiPendidikan);
            }
        });
    }

    $('.tombol-tutup-absen').on("click", function() {
        bersihkanAbsen();
    });

    $("#tombolAbsen").on("click", function() {
        var $tanggal = $("#inputTanggal").val();
        var $nim_nis = $("#absenNimNis").val();
        var $status = $("#absenStatus").val();
        var $keterangan = $("#absenKeterangan").val();
        var $checkin = $('#inputCheckin').val();
        var $foto = $("#absenFoto").val();

        $.ajax({
            url: "<?= site_url('Admin/Modal/tambahAbsensi') ?>",
            type: "POST",
            data: {
                tanggal: $tanggal,
                absen_nim_nis: $nim_nis,
                status: $status,
                keterangan: $keterangan,
                checkin: $checkin,
                foto: $foto
            },
            dataType: 'json',
            success: function(response) {
                // jika ada error
                if (response.error) {
                    if ($('#absenFoto').val() == '') {
                        $('#absenFoto').addClass('is-invalid');
                        $('.errorFoto').html('Foto harus diupload');
                    } else {
                        $('#absenFoto').removeClass('is-invalid');
                    }

                    if (response.error.tanggal) {
                        $('#inputTanggal').addClass('is-invalid');
                        $('.errorTanggal').html(response.error.tanggal);
                    }
                    if (response.error.absen_nim_nis) {
                        $('#absenNimNis').addClass('is-invalid');
                        $('.errorNim_nis').html(response.error.absen_nim_nis);
                    }
                    if (response.error.status) {
                        $('#absenStatus').addClass('is-invalid');
                        $('.errorStatus').html(response.error.status);
                    }
                    if (response.error.keterangan) {
                        $('#absenKeterangan').addClass('is-invalid');
                        $('.errorKeterangan').html(response.error.keterangan);
                    }
                    if (response.error.checkin) {
                        $('#inputCheckin').addClass('is-invalid');
                        $('.errorCheckin').html(response.error.checkin);
                    }
                    // value
                } else {
                    /**  jika sukses */
                    if ($('#absenFoto').val() == '') {
                        $('#absenFoto').addClass('is-invalid');
                        $('.errorFoto').html('Foto harus diupload');
                    } else {
                        $('#absenFoto').removeClass('is-invalid');
                        $('#myForm').submit();
                    }
                }
            },
        });
        hapusValidasiAbsen();
    });

    $('#tombolCheckout').on("click", function() {
        var $id = $('#inputID').val();
        var $checkout = $('#inputCheckout').val();

        $.ajax({
            url: '<?= site_url('Admin/Modal/checkoutModal') ?>',
            type: 'POST',
            data: {
                id: $id,
                checkout: $checkout
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    if (response.error.checkout) {
                        $('#inputCheckout').addClass("is-invalid");
                        $('.errorCheckout').html(response.error.checkout);
                    }
                } else {
                    refresh();
                }
            }
        });
        hapusValidasiCheckout();
    });

    $('.tombol-tutup-checkout').on("click", function() {
        bersihkan_checkout();
    });

    $("#tombolSave").on("click", function() {
        var $id = $("#superId").val();
        var $nama_lengkap = $("#superNamaLengkap").val();
        var $nim_nis = $("#superNimNis").val();
        var $username = $("#superUsername").val();
        var $email = $("#superEmail").val();
        var $password = $("#superPassword").val();
        var $no_hp = $("#superNoHP").val();
        var $role = $("#superRole").val();

        $.ajax({
            url: "<?= site_url('admin/SuperAdmin/super_admin_modal'); ?>",
            type: "POST",
            data: {
                super_id: $id,
                super_nama_lengkap: $nama_lengkap,
                super_nim_nis: $nim_nis,
                super_username: $username,
                super_password: $password,
                super_no_hp: $no_hp,
                super_email: $email,
                super_role: $role
            },
            dataType: 'json',
            success: function(response) {
                // jika ada error
                if (response.error) {
                    if (response.error.super_nama_lengkap) {
                        $("#superNamaLengkap").addClass("is-invalid");
                        $(".errornama_lengkap").html(response.error.super_nama_lengkap);
                    }
                    if (response.error.super_nim_nis) {
                        $("#superNimNis").addClass("is-invalid");
                        $(".errornim_nis").html(response.error.super_nim_nis);
                    }
                    if (response.error.super_username) {
                        $("#superUsername").addClass("is-invalid");
                        $(".errorusername").html(response.error.super_username);
                    }
                    if (response.error.super_email) {
                        $("#superEmail").addClass("is-invalid");
                        $(".erroremail").html(response.error.super_email);
                    }
                    if (response.error.super_password) {
                        $("#superPassword").addClass("is-invalid");
                        $(".errorpassword").html(response.error.super_password);
                    }
                    if (response.error.super_no_hp) {
                        $("#superNoHP").addClass("is-invalid");
                        $(".errorno_hp").html(response.error.super_no_hp);
                    }
                    if (response.error.super_role) {
                        $("#superRole").addClass("is-invalid");
                        $(".errorrole").html(response.error.super_role);
                    }
                } else if (response.sukses == true) {
                    /**  jika sukses */
                    refresh();
                    // window.location.reload(true);
                }
            },

        });
    });

    $(document).ready(function() {
        const table = $('#dTable').DataTable({
            dom: "lBfrtip",
            'columnDefs': [{
                "targets": [1],
                "className": "text-center"
            }, ]
        });

        $('#select').on('change', function() {
            var dropdown = $('#select').val();
            if (dropdown === "all") {
                table.columns(2).search('').draw();
            } else if (name === dropdown) {
                table.columns(2).search(dropdown).draw();
            } else {
                table.columns(2).search(dropdown).draw();
            }
        });

        $('.start_date, .end_date').on("change", function() {
            var startDateValue = $('.start_date').val();
            var endDateValue = $('.end_date').val();
            var filterForm = $('#filterForm');
            // Periksa apakah kedua nilai ada
            if (startDateValue && endDateValue) {
                filterForm.submit();
            }
        });
    });
</script>

</html>