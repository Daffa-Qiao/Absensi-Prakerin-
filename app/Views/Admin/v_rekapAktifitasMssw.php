<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->

<head>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.jqueryui.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.jqueryui.css" />
  <style>
    #dTableSsw_paginate {
      border: 2px solid black;
      padding: 0;
    }

    #dTableSsw_paginate span>* {
      border-right: .01px solid black;
      margin: 0;
    }

    #dTableSsw_paginate span>*:nth-child(1) {
      border-left: .01px solid black;
      margin: 0;
    }

    #dTableSsw_wrapper .dt-buttons {
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
    <div class="card-body m-auto py-2" style="width: 70%;">
      <form action="<?= route_to('/rekap-aktifitasSiswa'); ?>" method="post" id="filterForm">
        <!--row  -->
        <div class="row">
          <!-- col 1 -->
          <div class="col">
            <div class="col">
              <!-- start date -->
              <div class="form-group basic mb-0 my-2">
                <div class="input-wrapper">
                  <label for="" class="w-100 d-flex align-items-start m-0 text-dark">Start Date :
                  </label>
                  <input type="date" class="form-control start_date" id="Fdatepicker" name="start_date" placeholder="Tanggal Awal" value="<?= (isset($start_date) ? $start_date : ''); ?>" />
                  <input type="text" id="tanggalA" hidden>
                </div>
              </div>
              <!-- end date -->
              <div class="col-13">
                <div class="form-group basic mb-0 my-2">
                  <div class="input-wrapper">
                    <label for="" class="w-100 d-flex align-items-start m-0 text-dark">End Date :
                    </label>
                    <input type="date" class="form-control end_date" id="Ldatepicker" name="end_date" placeholder="Tanggal Akhir" value="<?= (isset($end_date) ? $end_date : ''); ?>" />
                    <input type="text" id="tanggalB" hidden>
                  </div>
                </div>
              </div>
              <!--full name  -->
              <div class="col-13">
                <label for="" class="w-100 d-flex align-items-start m-0 text-dark">Full Name :</label>
                <select name="namaLengkap" id="select" class="form-control">
                  <option value="all">Show :</option>
                  <?php foreach ($dataUser as $usr) : ?>
                    <option value="<?= $usr['nama_lengkap'] ?>">
                      <?= $usr['nama_lengkap'] ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-13 my-2 d-flex justify-content-center align-items-end">
            <a class="btn btn-secondary" href="<?= site_url('admin/rekap-aktifitas-siswa'); ?>">
              <i class="bi bi-arrow-repeat"></i>
            </a>
          </div>
            </div>
          </div>
          <!-- col 2 -->
          <div class="col ">
            <!-- button add activity -->
            <div class="col d-flex mt-5 justify-content-center">
              <button type="button" class="btn btn-primary bg-gradient-primary col-10 rounded-pill btnTambah custom-tambahkan custom-text fw-bold text-dark" data-toggle="modal" data-target="#modalActivity" attr-href="{{route('activity.tambah')}}"><i class="bi bi-pencil-square"></i> ADD ACTIVITY</button>
            </div>
            <!-- button monthly recap -->
            <div class="col d-flex mt-2 justify-content-center">
              <button class="btn btn-lg btn-warning bg-gradient-warning dropdown-toggle col-10 fw-bold custom-text rounded-pill text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:15px;">
              <i class="bi bi-arrow-bar-down"></i> MONTHLY RECAP
              </button>
              <div class="dropdown-menu col-9" aria-labelledby="dropdownMenuButton">
                <label class="dropdown-item d-flex justify-content-between fs-6 m-0" id="Pdf" for="toPdf">Pdf<i class="bi bi-file-earmark-pdf" style="color: #ff0033;"></i></label>
                <label class="toExcel dropdown-item d-flex justify-content-between fs-6 m-0" id="Excel" for="toExcel">Excel<i class="bi bi-file-earmark-excel" style="color: #3f8230;"></i></label>
              </div>
            </div>
            <!-- button export file -->
            <div class="col d-flex mt-2 justify-content-center">
              <button class="btn btn-lg btn-danger bg-gradient-danger dropdown-toggle col-10 fw-bold custom-text rounded-pill text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:15px;">
              <i class="bi bi-arrow-bar-down"></i> EXPORT FILE
              </button>
              <div class="dropdown-menu col-9" aria-labelledby="dropdownMenuButton">
                <label class="dropdown-item d-flex justify-content-between fs-6 m-0" id="Pdf" for="toPdf">Pdf<i class="bi bi-file-earmark-pdf" style="color: #ff0033;"></i></label>
                <label class="toExcel dropdown-item d-flex justify-content-between fs-6 m-0" id="Excel" for="toExcel">Excel<i class="bi bi-file-earmark-excel" style="color: #3f8230;"></i></label>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>


  <!-- DataTales Example -->
  <div class="title text-dark font-weight-bold px-1 rounded-top mt-5 pl-3">
  Student Activity List
  </div>
  <div class="card shadow mb-2" style="border-radius: 0px;">
    <div class="card-body border-bottom">
      <div class="table-responsive">
        <table id="dTableSsw" class="nowrap table table-bordered" style="width: 100%; background-color:white;">
          <thead class="border">
            <tr>
            <th data-f-bold="true" data-a-h="left" class="text-center">No.</th>
            <th data-f-bold="true" data-a-h="left" class="text-center">No.</th>
              <th data-f-bold="true" style="min-width: 190px" class="text-center">Name</th>
              <th data-f-bold="true" style="min-width: 190px" class="text-center">School Name</th>
              <th data-f-bold="true" style="min-width: 170px" class="text-center">Location</th>
              <th data-f-bold="true" style="min-width: 70px" class="text-center">Start Time</th>
              <th data-f-bold="true" style="min-width: 80px" class="text-center">Finish Time</th>
              <th data-f-bold="true" style="min-width: 120px" class="text-center">Documentation</th>
              <th data-f-bold="true" style="min-width: 180px" class="text-center">Description</th>
              <th data-f-bold="true" style="min-width: 80px" class="text-center">Status</th>
            </tr>
          </thead>
          <tbody class="border">
            <?php foreach ($dataLaporan as $v) {
              if ($v['status'] == 'Masuk') {
                $status = 'hadir';
              } else if ($v['status'] == 'Izin') {
                $status = 'izin';
              } else {
                $status = 'sakit';
              }

              ?>
              <tr>
                <td class="text-center" data-t="n">
                  <?= $nomor; ?>
                </td>
                <td>
                  <?= $v['nama_lengkap']; ?>
                </td>
                <td>
                  <?= tanggal_indo($v['waktu_absen']) ?>
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
</div>
<!-- /.container-fluid -->
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

<script>
  <?php if (session()->getFlashdata('swal_icon')): ?>
    Swal.fire({
      icon: '<?= session()->getFlashdata('swal_icon'); ?>',
      title: '<?= session()->getFlashdata('swal_title'); ?>',
      showConfirmButton: false,
      timer: 1500
    })
  <?php endif; ?>

  // pdf/Excel
  let today = new Date();
  let day = `${today.getDate() < 10 ? "0" : ""}${today.getDate()}`;
  let month = `${today.getMonth() + 1 < 10 ? "0" : ""}${today.getMonth() + 1}`;
  let year = today.getFullYear();
  let hours = today.getHours();
  let minutes = `${today.getMinutes() < 10 ? "0" : ""}${today.getMinutes()}`;
  let seconds = `${today.getSeconds() < 10 ? "0" : ""}${today.getSeconds()}`;

  let current_time = `${day}-${month}-${year}, ${hours}.${minutes}.${seconds}`;


  $(document).ready(function () {
    const table = $('#dTableSsw').DataTable({
      dom: "lBfrtip",
      'columnDefs': [
        {
          "targets": [1],
          "className": "text-center"
        },
      ],
      buttons: [
        {
          extend: 'excelHtml5',
          title: `Rekap Laporan Siswa ${current_time} WIB`,
          exportOptions: {
            columns: ':visible:not(.hilang)'
          }
        },
        {
          extend: 'pdfHtml5',
          title: `Rekap Laporan Siswa ${current_time} WIB`,
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