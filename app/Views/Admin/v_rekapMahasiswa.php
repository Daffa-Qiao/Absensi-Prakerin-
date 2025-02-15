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
    .custom-tambahkan {
        box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        transition-duration : 0.5s;
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
        <div class="row text-center justify-content-center py-2">
            <div class="col-sm-2 col-md-4 d-flex flex-column align-items-end pb-2">
                <label for="" class="w-100 d-flex align-items-start m-0 text-dark">Name :</label>
                <select name="namaLengkap" id="select" class="form-control">
                    <option value="all">Show All :</option>
                    <?php foreach ($dataUser as $usr): ?>
                    <option value="<?= $usr['nama_lengkap'] ?>">
                        <?= $usr['nama_lengkap'] ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-sm-4 col-md-5 my-3 d-flex justify-content-center">
                <button type="button" class="btn btn-warning bg-gradient-warning col-6 rounded-pill btnTambah custom-tambahkan custom-text fw-bold text-dark custom-tambahkan" id="buttonPdf" for="toPdf"><i class="bi bi-file-earmark-pdf"></i> EXPORT FILE</button>
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
                        <th style="vertical-align: middle; max-width: 30px; border: 1px solid black; padding: 4px; text-align: center;"
                            rowspan="2">No</th>
                        <th style="vertical-align: middle; border: 1px solid black; padding: 4px; text-align: center;"
                            rowspan="2">Name</th>
                        <th style="vertical-align: middle; border: 1px solid black; padding: 4px; text-align: center;"
                            rowspan="2">NIM/NIS</th>
                        <th style="vertical-align: middle; border: 1px solid black; padding: 4px; text-align: center;"
                            rowspan="2">Name of Educational Institutions</th>
                        <th colspan="5" style="border: 1px solid black; padding: 4px; text-align: center;">Total Absences</th>
                    </tr>
                    <tr>
                        <th colspan="1" style="border: 1px solid black; padding: 4px; text-align: center;">A</th>
                        <th colspan="1" style="border: 1px solid black; padding: 4px; text-align: center;">AB</th>
                        <th colspan="1" style="border: 1px solid black; padding: 4px; text-align: center;">S</th>
                        <th colspan="1" style="border: 1px solid black; padding: 4px; text-align: center;">P</th>
                        <th colspan="1" style="border: 1px solid black; padding: 4px; text-align: center;">TA</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <?php foreach ($dataAbsen as $v) {
                        $dataUser = $user->where('nim_nis', $v->nim_nis)->get()->getRow();

                        $namaLengkap = $dataUser ? $dataUser->nama_lengkap : 'User Telah Dihapus';
                        $nama_instansi = $dataUser ? $dataUser->nama_instansi : '';
                        $nim_nis = $dataUser ? $dataUser->nim_nis : '';
                        $jenis_user = $dataUser ? $dataUser->jenis_user : $v->jenis_user;
                        ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $namaLengkap; ?></td>
                        <td><?= $nim_nis ?></td>
                        <td><?= $nama_instansi ?></td>

                        <td>
                            <?= $totalAbsensi[$v->nim_nis]['masuk']; ?>
                        </td>
                        <td>
                            <?= $totalAbsensi[$v->nim_nis]['alpa']; ?>
                        </td>
                        <td>
                            <?= $totalAbsensi[$v->nim_nis]['sakit']; ?>
                        </td>
                        <td>
                            <?= $totalAbsensi[$v->nim_nis]['izin']; ?>
                        </td>
                        <td>
                            <?= $totalAbsensi[$v->nim_nis]['izin'] + $totalAbsensi[$v->nim_nis]['sakit'] + $totalAbsensi[$v->nim_nis]['alpa']; ?>
                        </td>
                    </tr>
                    <?php
                        $nomor++;
                    } ?>
                </tbody>
                <form action="<?= base_url('/print/pdf'); ?>" method="post" id="printPDF"></form>
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


$(document).ready(function() {
    const table = $('#dTableMhs').DataTable({
        dom: "lBfrtip",
        "columnDefs": [{
            // "targets": [1],
        }],
        buttons: [{
                extend: 'excelHtml5',
                title: `LOG ACTIVITY`,
                exportOptions: {
                    columns: ':visible:not(.hilang)'
                }
            },
            {
                extend: 'pdfHtml5',
                title: `LOG ACTIVITY`,
                orientation: 'portrait',
                pageSize: 'A4',
                customize: function(doc) {
                    // Custom styling for the table
                    doc.content.forEach(function(item) {
                        if (item.table) {
                            item.table.headerRows = 1;

                            // Adjust column widths and cell margins
                            item.table.widths = Array(item.table.body[0].length).fill(
                                '*');
                            item.table.body.forEach(function(row) {
                                row.forEach(function(cell) {
                                    cell.margin = [4, 6, 4,
                                        6
                                    ]; // Top, right, bottom, left
                                });
                            });
                        }
                    });

                    // Style the table header
                    doc.styles.tableHeader = {
                        bold: true,
                        fontSize: 10,
                        color: 'black',
                        fillColor: '#f3f3f3',
                        alignment: 'center',
                        margin: [4, 4, 4, 4]
                    };

                    // Style table body cells
                    doc.styles.tableBodyEven = {
                        fontSize: 8,
                        alignment: 'center',
                        margin: [4, 4, 4, 4]
                    };
                    doc.styles.tableBodyOdd = {
                        fontSize: 8,
                        alignment: 'center',
                        margin: [4, 4, 4, 4]
                    };

                    // Page margins
                    doc.pageMargins = [20, 30, 20, 30];
                }
            }


        ]


    });

    // document.querySelector(".buttons-pdf").setAttribute("id", "toPdf");
    document.querySelector(".buttons-excel").setAttribute("id", "toExcel");

    document.getElementById("buttonPdf").addEventListener("click", function() {
        <?php
            session()->set('dataAbsen', $dataAbsen);
            ?>

        $('#printPDF').submit();
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

<script src="<?= base_url('admin'); ?>/js/table2excel.js"></script>

<!-- End of Main Content -->
<?= $this->endSection(); ?>