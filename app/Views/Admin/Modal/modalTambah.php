<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">+ Tambah User Baru</h5>
                <button type="button" class="close tombol-tutup" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <!-- FOTM INPUT DATA -->
                <div class="mb-3">
                    <label for="inputNamaLengkap" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="inputNamaLengkap" placeholder="">
                    <div class=" invalid-feedback errornama_lengkap">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputNimNis" class="form-label">NIM / NIS</label>
                    <input type="text" class="form-control" name="nim_nis" id="inputNimNis" placeholder="">
                    <div class="invalid-feedback errornim_nis">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="Username" id="inputUsername" placeholder="">
                    <div class="invalid-feedback errorusername">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" id="inputPassword" value="12345678" readonly>
                </div>
                <div class="mb-3">
                    <label for="inputGender" class="form-label">Gender</label>
                    <select name="gender" class="custom-select" id="inputGender">
                        <option value="" hidden></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback errorgender">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputNoHP" class="form-label">No Telepon</label>
                    <input type="number" class="form-control" name="no_hp" id="inputNoHP" placeholder="08xxxx"
                        pattern="[0-9]{4}[0-9]{4}[0-9]{5}">
                    <div class="invalid-feedback errorno_hp">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" placeholder="">
                    <div class="invalid-feedback erroremail">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputInstansi" class="form-label">Instansi Pendidikan</label>
                    <select name="instansi" class="custom-select" id="inputInstansi">
                        <option value="" hidden></option>
                        <option value="School">School</option>
                        <option value="University">University</option>
                    </select>
                    <div class="invalid-feedback errorinstansi">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputNamaInstansi" class="form-label">Nama Instansi</label>
                    <input type="text" class="form-control" name="nama_instansi" id="inputNamaInstansi" placeholder="">
                    <div class="invalid-feedback errornama_instansi">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputNamaPembimbing" class="form-label">Nama Guru Pembimbing</label>
                    <input type="text" class="form-control" name="nama_pembimbing" id="inputNamaPembimbing" placeholder="">
                    <div class="invalid-feedback errornama_pembimbing">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputNoPembimbing" class="form-label">No Guru Pembimbing</label>
                    <input type="number" class="form-control" name="no_pembimbing" id="inputNoPembimbing" placeholder="08xxxx"
                        pattern="[0-9]{4}[0-9]{4}[0-9]{5}">
                    <div class="invalid-feedback errorno_pembimbing">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombol-tutup" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-simpan" id="tombolSimpan">Simpan</button>
            </div>
        </div>
    </div>
</div>