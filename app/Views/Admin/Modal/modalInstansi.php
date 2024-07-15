<div class="modal fade" id="modalInstansi" tabindex="-1" role="dialog" aria-labelledby="modalInstansiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modalInstansiLabel">Detail Instansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= site_url('admin/instansi-modal'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="wrapper-text d-flex flex-column justify-content-center">
                        <input type="hidden" id="id_instansi">
                        <div class="mb-3">
                            <label for="instansiNama" class="text-dark mt-1">Educational Institutions Name</label>
                            <input type="text" name="instansi_nama" class="form-control" id="instansiNama" readonly />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="instansiJumlah" class="text-dark mt-1">Student Total : </label>
                            <input type="text" name="instansi_jumlah" class="form-control" id="instansiJumlah" readonly />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="instansiPendidikan" class="text-dark mt-1">Educational Institutions :</label>
                            <input type="text" name="instansi_pendidikan" class="form-control" id="instansiPendidikan" readonly />

                        </div>
                        <label for="" class="text-dark">Educational Institutions Logo : </label>
                        <div class="logo d-flex justify-content-center p-3 border rounded">
                            <div class="wrapper-logo w-75 d-flex align-items-end justify-content-around">
                                <label for="logo" class="btn btn-dark mb-0 py-1 px-3">Pilih File</label>
                                <input type="file" name="foto_logo" id="logo" accept=".png, .jpg, .jpeg" hidden />
                                <div class="wrapperImg border-dark p-1 d-flex justify-content-center" id="display_image">
                                    <img src="<?= base_url('admin'); ?>/img/sekolah.png" alt="" class="rounded" style="width: 120px; height: 120px" />
                                </div>
                            </div>
                            <div class="invalid-feedback errorlogo"></div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary bg-gradient-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient-primary" id="simpanInstansi">Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>