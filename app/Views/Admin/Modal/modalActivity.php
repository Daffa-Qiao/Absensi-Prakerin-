<head>
    <!-- <style>
        input[type="date"]::before {
            content: attr(placeholder);
            color: gray;
        }
    </style> -->
</head>
<div class="modal fade" id="modalActivity" tabindex="-1" role="dialog" aria-labelledby="modalAbsenLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAbsenLabel">Add Activity User</h5>
                <button type="button" class="close tombol-tutup-absen" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </button>
            </div>
            <form action="<?= site_url('data-aktifitasProcess'); ?>" method="post" enctype="multipart/form-data"
                id="myForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="laporanNimNis">NIM/NIS</label>
                        <input type="text" name="absen_nim_nis" class="form-control autoDropdown" id="absenNimNis" />
                       <!-- <select name="nim_nis" id="laporanNimNis" class="form-control">
                        <?php foreach ($dataUser as $usr): ?>
                        <option value="" hidden></option>
                        <option value="<?= $usr['nim_nis'] ?>">
                            <?= $usr['nama_lengkap'] ?>
                        </option>
                        <?php endforeach ?>
                    </select> -->
                    <div class="invalid-feedback errornim_nis">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="activityStatus">Status</label>
                        <select name="status" id="laporanStatus" class="custom-select">
                            <option value="" hidden></option>
                            <option value="Progress">Progress</option>
                            <option value="Closed">Closed</option>
                        </select>
                        <div class="invalid-feedback errorStatus">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="activityStatus">Location</label>
                        <input type="text" name="lokasi" id="inputLokasi" class="form-control">
                        <div class="invalid-feedback errorLocation">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="waktuMulai">Start Time</label>
                        <input type="time" name="waktu_mulai" id="laporanMulai" class="form-control">
                        <div class="invalid-feedback errorStart">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="waktuSelesai">Finish Time</label>
                        <input type="time" name="waktu_selesai" id="laporanSelesai" class="form-control">
                        <div class="invalid-feedback errorFinish">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="laporanFoto" name="foto"
                                accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="absenFoto" data-browse="Choose">Choose File</label>
                            <div class="invalid-feedback errorFoto">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="absenKeterangan">Description</label>
                        <textarea name="keterangan" id="laporanKeterangan" cols="30" rows="5" class="form-control"
                            placeholder="Description must be filled"></textarea>
                        <div class="invalid-feedback errorKeterangan">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Date</label>
                        <input type="date" name="tanggal" class="date form-control" data-toggle="datepicker"
                            autocomplete="none" id="inputTanggal" />
                        <div class=" invalid-feedback errorTanggal">

                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombol-tutup-absen" data-dismiss="modal"
                    id="tombol-tutup-aktifitas">Close</button>
                <button type="button" class="btn btn-primary tombol-submit-activity" id="tombolActivity">Submit</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('admin'); ?>/js/mdb.js"></script>
