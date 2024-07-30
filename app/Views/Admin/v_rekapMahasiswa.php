<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->

<head>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.jqueryui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.jqueryui.css" />
    <style>
        #dTableMhs_paginate {
            border: 2px solid black;
            padding: 0;
        }

        #dTableMhs_paginate span>* {
            border-right: .01px solid black;
            margin: 0;
        }

        #dTableMhs_paginate span>*:nth-child(1) {
            border-left: .01px solid black;
            margin: 0;
        }

        #dTableMhs_wrapper .dt-buttons {
            display: none;
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
            <form action="<?= route_to('/rekap-mahasiswa'); ?>" method="post" id="filterForm">
                <div class="row text-center justify-content-center ">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group basic mb-0 my-2">
                            <div class="input-wrapper">
                                <label for="" class="w-100 d-flex align-items-start m-0 text-dark">Start Date :
                                </label>
                                <input type="date" class="form-control start_date" id="Fdatepicker" name="start_date"
                                    placeholder="Tanggal Awal"
                                    value="<?= (isset($start_date) ? $start_date : ''); ?>" />
                                <input type="text" id="tanggalA" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 my-2">
                        <div class="form-group basic mb-0">
                            <div class="input-wrapper">
                                <label for="" class="w-100 d-flex align-items-start m-0 text-dark">End Date :
                                </label>
                                <input type="date" class="form-control end_date" id="Ldatepicker" name="end_date"
                                    placeholder="Tanggal Akhir" value="<?= (isset($end_date) ? $end_date : ''); ?>" />
                                <input type="text" id="tanggalB" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 my-2 d-flex justify-content-center align-items-end">
                        <a class="btn btn-secondary" href="<?= site_url('admin/rekap-mahasiswa'); ?>">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                    <input type="text" id="textResult" hidden>
                    <input type="text" id="dateFilter" hidden>
            </form>
        </div>
        <div class="row text-center justify-content-center py-2">
            <div class="col-sm-2 col-md-4 d-flex align-items-end pb-2">
                <select name="namaLengkap" id="select" class="form-control">
                    <option value="all">Full Name:</option>
                    <?php foreach ($dataUser as $usr): ?>
                        <option value="<?= $usr['nama_lengkap'] ?>">
                            <?= $usr['nama_lengkap'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-sm-4 col-md-5 my-2 d-flex justify-content-center">
                <button class=" but-gap btn btn-warning bg-gradient-warning dropdown-toggle col-sm-4 col-md-4 col-lg-5 text-dark"
                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa-solid fa-file-export"></i> Export File
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <label class="dropdown-item d-flex justify-content-between fs-6 m-0" id="Pdf" for="toPdf">Pdf<i
                            class="fa-regular fa-file-pdf text-center d-flex align-items-center"
                            style="color: #ff0033"></i></label>
                    <label class="toExcel dropdown-item d-flex justify-content-between fs-6 m-0" id="Excel"
                        for="toExcel">Excel<i class="fa-regular fa-file-excel text-center d-flex align-items-center"
                            style="color: #3f8230; width: 16px"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="title text-dark font-weight-bold px-1 rounded-top mt-5 pl-3">
Attendance List
</div>
<div class="card shadow mb-2" style="border-radius: 0px;">
    <div class="card-body border-bottom">
        <div class="table-responsive">
            <table id="dTableMhs" class="nowrap table table-bordered" style="width: 100%; background-color:white;">
                <thead class="border">
                    <tr>
                        <th data-f-bold="true" data-a-h="left" class="text-center">No.</th>
                        <th data-f-bold="true" style="min-width: 190px" class="text-center">Date</th>
                        <th data-f-bold="true" style="min-width: 150px" class="text-center">Full Name</th>
                        <th data-f-bold="true" style="min-width: 90px" class="text-center">SSW / MHS</th>
                        <th data-f-bold="true" style="min-width: 70px" class="text-center">Check-In</th>
                        <th data-f-bold="true" style="min-width: 80px" class="text-center">Check-Out</th>
                        <th data-f-bold="true" class="text-center">Status</th>
                        <th data-f-bold="true" class="text-center">Description</th>
                        <th data-exclude="true" class="text-center">Photo</th>
                        <th data-f-bold="true" style="min-width: 160px;" class="text-center">Latitude / Longitude</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <?php foreach ($dataAbsen as $v) {
                        if ($v['status'] == 'Masuk') {
                            $status = 'hadir';
                        } else if ($v['status'] == 'Izin') {
                            $status = 'izin';
                        } else {
                            $status = 'sakit';
                        }

                        ?>
                        <tr>
                            <td class="text-center" data-t="n" data-a-h="left">
                                <?= $nomor; ?>
                            </td>
                            <td>
                                <?= tanggal_indo($v['waktu_absen']) ?>
                            </td>
                            <td>
                                <?= $v['nama_lengkap']; ?>
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
                                <div class="status <?= $status ?>">
                                    <?= $v['status']; ?>
                                </div>
                            </td>
                            <td>
                                <?= $v['keterangan']; ?>
                            </td>
                            <td data-exclude="true">
                                <?php if ($v['foto_absen'] != ''): ?>
                                    <img src="<?= base_url('uploadFoto/' . $v['foto_absen']) ?>" id="" alt=""
                                        onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $v['foto_absen']) ?>')">
                                <?php endif ?>
                            </td>
                            <td>

                                <?= $v['lokasi']; ?>
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
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <?php if (session()->getFlashdata('swal_icon')): ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon'); ?>',
            title: '<?= session()->getFlashdata('swal_title'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    <?php endif; ?>

    // ajax
    let today = new Date();
    let day = `${today.getDate() < 10 ? "0" : ""}${today.getDate()}`;
    let month = `${today.getMonth() + 1 < 10 ? "0" : ""}${today.getMonth() + 1}`;
    let year = today.getFullYear();
    let hours = today.getHours();
    let minutes = `${today.getMinutes() < 10 ? "0" : ""}${today.getMinutes()}`;
    let seconds = `${today.getSeconds() < 10 ? "0" : ""}${today.getSeconds()}`;

    let current_time = `${day}-${month}-${year}, ${hours}.${minutes}.${seconds}`;


    $(document).ready(function () {
        const table = $('#dTableMhs').DataTable({
            dom: "lBfrtip",
            'columnDefs': [
                {
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    "className": "text-center"
                },
            ],
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: `Rekap Absensi Mahasiswa ${current_time} WIB`,
                    exportOptions: {
                        columns: ':visible:not(.hilang)'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Rekap Absensi Mahasiswa ${current_time} WIB`,
                    exportOptions: {
                        columns: ':visible:not(.hilang)'
                    }
                }
            ],
        });
        document.querySelector(".buttons-pdf").setAttribute("id", "toPdf");
        document.querySelector(".buttons-excel").setAttribute("id", "toExcel");

        $('#select').on('change', function () {
            var dropdown = $('#select').val();
            if (dropdown === "all") {
                table.columns(2).search('').draw();
            } else if (name === dropdown) {
                table.columns(2).search(dropdown).draw();
            } else {
                table.columns(2).search(dropdown).draw();
            }
        });

        $('.start_date, .end_date').on("change", function () {
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

<script src="<?= base_url('admin'); ?>/js/table2excel.js"></script>

<!-- End of Main Content -->
<?= $this->endSection(); ?>