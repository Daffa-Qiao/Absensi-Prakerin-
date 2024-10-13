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
            <form action="<?= site_url('data-absenProcess'); ?>" method="post" enctype="multipart/form-data"
                id="myForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="absenNimNis">NIM/MIS</label>
                        <input type="text" class="form-control" name="nim_nis" id="inputNimNis" placeholder="">
                        <div class="invalid-feedback errornim_nis">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="activityStatus">Status</label>
                        <select name="status" id="activityStatus" class="custom-select">
                            <option value="" hidden></option>
                            <option value="Progres">Progres</option>
                            <option value="Closed">Closed</option>
                        </select>
                        <div class="invalid-feedback errorStatus">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="activityStatus">Location</label>
                        <input type="location" name="location" id="inputLocation" class="form-control">
                        <div class="invalid-feedback errorLocation">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="startTime">Start Time</label>
                        <input type="time" name="start" id="inputStart" class="form-control">
                        <div class="invalid-feedback errorStart">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="finishTime">Finish Time</label>
                        <input type="time" name="finish" id="inputFinish" class="form-control">
                        <div class="invalid-feedback errorFinish">
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
                        <label for="absenKeterangan">Description</label>
                        <textarea name="keterangan" id="absenKeterangan" cols="30" rows="5" class="form-control"
                            placeholder="Description must be filled in if the status is permit or sick"></textarea>
                        <div class="invalid-feedback errorKeterangan">
                        </div>
                    </div>

                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombol-tutup-absen" data-dismiss="modal"
                    id="tombol-tutup-absen">Close</button>
                <button type="button" class="btn btn-primary tombol-submit-activity" id="tombolActivity">Submit</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('admin'); ?>/js/mdb.js"></script>
