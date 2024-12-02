<head>
    <style>
        input[type="date"]::before {
            content: attr(placeholder);
            color: gray;
        }
    </style>
</head>
<div class="modal fade" id="modalAbsen" tabindex="-1" role="dialog" aria-labelledby="modalAbsenLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAbsenLabel">Add Absence User</h5>
                <button type="button" class="close tombol-tutup-absen" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </button>
            </div>
            <form action="<?= site_url('data-absenProcess'); ?>" method="post" enctype="multipart/form-data"
                id="myForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="absenNimNis">Full Name</label>
                        <select name="absen_nim_nis"  id="absenNimNis"  class="custom-select">
                            <option value="" hidden></option>
                        <?php foreach ($dataUser as $usr) : ?>
                            <option value="<?= $usr['nim_nis'] ?>">
                                <?= $usr['nama_lengkap'] ?>
                            </option>
                        <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorNim_nis">

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="absenStatus">Status</label>
                        <select name="status" id="absenStatus" class="custom-select">
                            <option value="" hidden></option>
                            <option value="Masuk">Attend</option>
                            <option value="Izin">Permit</option>
                            <option value="Sakit">Sick</option>
                            <option value="Alpa">Absences</option>
                        </select>
                        <div class="invalid-feedback errorStatus">

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="absenKeterangan">Description</label>
                        <textarea name="keterangan" id="absenKeterangan" cols="30" rows="5" class="form-control"
                            placeholder="Description must be filled in if the status is permit or sick"></textarea>
                        <div class="invalid-feedback errorKeterangan">

                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="absenFoto" name="foto"
                                accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="absenFoto" data-browse="Choose">Choose File</label>
                            <div class="invalid-feedback errorFoto">

                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputCheckin">Check-In</label>
                        <input type="time" name="checkin" id="inputCheckin" class="form-control">
                        <div class="invalid-feedback errorCheckin">

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
                    id="tombol-tutup-absen">Close</button>
                <button type="button" class="btn btn-primary tombol-submit-absen" id="tombolAbsen">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<script src="<?= base_url('admin'); ?>/js/mdb.js"></script>
<script>


</script>