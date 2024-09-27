<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<?php include(APPPATH . 'Views/Admin/Modal/modalAbsen.php') ?>
<?php include(APPPATH . 'Views/Admin/Modal/modalCheckout.php') ?>

<!-- Begin Page Content -->

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.jqueryui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.jqueryui.css" />
    <style>
        #dTable_paginate {
            border: 2px solid black;
            padding: 0;
        }

        #dTable_paginate span>* {
            border-right: .01px solid black;
            margin: 0;
        }

        #dTable_paginate span>*:nth-child(1) {
            border-left: .01px solid black;
            margin: 0;
        }
    </style>
</head>
<?php if (session()->getFlashdata('data')) {
    $flashData = session()->getFlashdata('data');
    $dataAbsen = $flashData['dataFilter'];
    $start_date = $flashData['start_date'];
    $end_date = $flashData['end_date'];
} ?>

<div class="container-fluid p-0">
    <div class="card mt-3">
        <div class="card-body m-auto py-2" style="width: 90%">
            <form action="<?= route_to('/data-absen'); ?>" method="post" id="filterForm">
                <div class="row text-center justify-content-center ">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group basic mb-0 my-2">
                            <div class="input-wrapper">
                                <label for="" class="w-100 d-flex align-items-start m-0 text-dark">Start Date :
                                </label>
                                <input type="date" class="form-control start_date" id="Fdatepicker" name="start_date" value="<?= (isset($start_date) ? $start_date : ''); ?>" />
                                <input type="text" id="tanggalA" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 my-2">
                        <div class="form-group basic mb-0">
                            <div class="input-wrapper">
                                <label for="" class="w-100 d-flex align-items-start m-0 text-dark">End Date :
                                </label>
                                <input type="date" class="form-control end_date" id="Ldatepicker" name="end_date" value="<?= (isset($end_date) ? $end_date : ''); ?>" />
                                <input type="text" id="tanggalB" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 my-2 d-flex justify-content-center align-items-end">
                        <a class="btn btn-secondary" id="reset" href="<?= site_url('admin/data-absen'); ?>">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </div>
            </form>
            <div class="row text-center justify-content-center py-2">
                <div class="col-sm-2 col-md-4 d-flex align-items-end pb-2">
                    <select name="namaLengkap" id="select" class="form-control">
                        <option value="all">Show All</option>
                        <?php foreach ($dataUser as $usr) : ?>
                            <option value="<?= $usr['nama_lengkap'] ?>">
                                <?= $usr['nama_lengkap'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-sm-4 col-md-5 my-2 d-flex justify-content-center">
                    <button type="button" class="but-gap btn btn-primary bg-gradient-primary col-6 btnTambah" data-toggle="modal" data-target="#modalAbsen" attr-href="{{route('absen.tambah')}}"><i class="fa-solid fa-pen"></i> Add Absence </button>
                </div>

            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="title text-dark font-weight-bold px-1 rounded-top mt-5 pl-3">List Absensi</div>
    <div class="card shadow mb-2">
        <div class="card-body border-bottom">
            <div class="table-responsive">
                <table class="nowrap table table-bordered" id="dTable" style="width: 100%; background-color:white;">
                    <thead class="border">
                        <tr>
                            <th>No</th>
                            <th style="min-width: 190px" class="text-center">Date</th>
                            <th style="min-width: 200px">Name</th>
                            <th style="min-width: 200px">Educational Institutions </th>
                            <th style="min-width: 90px">Student/College Student</th>
                            <th style="min-width: 70px">Check-In</th>
                            <th style="min-width: 80px">Check-Out</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th style="min-width: 140px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border" id="dataTableBody">
                        <?php foreach ($dataAbsen as $v) {
                            if ($v['status'] == 'Masuk') {
                                $status = 'hadir';
                            } else if ($v['status'] == 'Izin') {
                                $status = 'izin';
                            } else if ($v['status'] == 'Sakit')  {
                                $status = 'sakit';
                            } else {
                                $status = 'alpa';
                            }
                        ?>
                            <tr id="">
                                <td class="text-center">
                                    <?= $nomor; ?>
                                </td>
                                <td>
                                    <?= tanggal_indo($v['waktu_absen']) ?>
                                </td>
                                <td>
                                    <?= $nama_lengkap[$v['nim_nis']] ?>
                                </td>
                                <td>
                                    <?= $v['nama_instansi']; ?>
                                </td>
                                <td>
                                    <?= $v['jenis_user']; ?>
                                </td>
                                <td>
                                    <?= $v['checkin_time']; ?>
                                </td>
                                <td>
                                    <?= $v['checkout_time']; ?>
                                </td>
                                <td>
                                    <div class="status <?= (isset($status)) ? $status : '' ?>">
                                        <?= $v['status']; ?>
                                    </div>
                                </td>
                                <td>
                                    <?= $v['keterangan']; ?>
                                </td>
                                <td>
                                    <?php if ($v['foto_absen'] != '') : ?>
                                        <img src="<?= base_url('uploadFoto/' . $v['foto_absen']) ?>" alt="" onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $v['foto_absen']) ?>')">
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-circle mb-1" onclick="hapus_absen(<?= $v['id'] ?>)">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <a class="btn btn-warning mb-1" data-toggle="modal" data-target="#modalCheckout" onclick="checkout(<?= $v['id'] ?>)">
                                        Check-Out
                                    </a>
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
<!-- End of Main Content -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module">
    <?php if (session()->getFlashdata('swal_icon')) : ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    <?php endif; ?>

    // ajax
    <?php if (session()->getFlashdata('swal_icon')) : ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    <?php endif; ?>

    

    function checkout($id) {
        $.ajax({
            url: "<?= site_url('Admin/Modal/checkout') ?>/" + $id,
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.id != "") {
                    $("#inputID").val(response.id);
                }
            },
        });
    }

    function hapusValidasiAbsen() {
        $('#inputTanggal').removeClass('is-invalid');
        $('#absenNamaLengkap').removeClass('is-invalid');
        $('#absenNimNis').removeClass('is-invalid');
        $('#absenJenisUser').removeClass('is-invalid');
        $('#absenStatus').removeClass('is-invalid');
        $('#inputCheckin').removeClass('is-invalid');
        $('#absenKeterangan').removeClass('is-invalid');
        $('#absenFoto').removeClass('is-invalid');
    }

    function bersihkanAbsen() {
        $('#inputTanggal').removeClass('is-invalid');
        $('#absenNamaLengkap').removeClass('is-invalid');
        $('#absenNimNis').removeClass('is-invalid');
        $('#absenJenisUser').removeClass('is-invalid');
        $('#absenStatus').removeClass('is-invalid');
        $('#inputCheckin').removeClass('is-invalid');
        $('#absenKeterangan').removeClass('is-invalid');
        $('#absenFoto').removeClass('is-invalid');

        $('#inputTanggal').val('');
        $('#absenNamaLengkap').val('');
        $('#absenNimNis').val('');
        $('#absenJenisUser').val('');
        $('#absenStatus').val('');
        $('#inputCheckin').val('');
        $('#absenKeterangan').val('');
        $('#absenFoto').val('');
    }

    function hapusValidasiCheckout() {
        $('#inputCheckout').removeClass('is-invalid');
    }

    function bersihkan_checkout() {
        $('#inputCheckout').removeClass('is-invalid');

        $('#inputCheckout').val('');
    }
    // end ajax

    // $(document).ready(function () {
    //     const table = $('#dTable').DataTable({
    //         dom: "lBfrtip",
    //         'columnDefs': [
    //             {
    //                 "targets": [1],
    //                 "className": "text-center"
    //             },
    //         ]
    //     });

    //     $('#select').on('change', function () {
    //         var dropdown = $('#select').val();
    //         if (dropdown === "all") {
    //             table.columns(2).search('').draw();
    //         } else if (name === dropdown) {
    //             table.columns(2).search(dropdown).draw();
    //         } else {
    //             table.columns(2).search(dropdown).draw();
    //         }
    //     });

    //     $('.start_date, .end_date').on("change", function () {
    //         var startDateValue = $('.start_date').val();
    //         var endDateValue = $('.end_date').val();
    //         var filterForm = $('#filterForm');
    //         // Periksa apakah kedua nilai ada
    //         if (startDateValue && endDateValue) {
    //             filterForm.submit();
    //         }
    //     });
    // });

    

</script>


<!-- End of Main Content -->
<?= $this->endSection(); ?>