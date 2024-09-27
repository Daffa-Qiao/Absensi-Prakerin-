<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit User</h5>
                <button type="button" class="close tombol-tutup-edit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Input ID -->
                <input name="id" type="hidden" id="inputId">
                <input type="hidden" name="dataNim_Nis" id="dataNim_Nis">
                <!-- FOTM INPUT DATA -->
                <div class="mb-3">
                    <label for="editNamaLengkap" class="form-label">Name</label>
                    <input type="text" class="form-control" name="edit_nama_lengkap" id="editNamaLengkap" placeholder="">
                    <div class="invalid-feedback errorEdit_nama_lengkap">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editNimNis" class="form-label">NIM / NIS</label>
                    <input type="text" class="form-control" name="edit_nim_nis" id="editNimNis" placeholder="">
                    <div class="invalid-feedback errorEdit_nim_nis">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="edit_Username" id="editUsername" placeholder="">
                    <div class="invalid-feedback errorEdit_username">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editPassword" class="form-label">Password</label>
                    <input type="text" class="form-control" name="edit_Password" id="editPassword" placeholder="">
                    <div class="invalid-feedback errorEdit_password">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editGender" class="form-label">Gender</label>
                    <select name="edit_gender" class="custom-select" id="editGender">
                        <option value="" hidden></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback errorEdit_gender">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editNoHP" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" name="edit_no_hp" id="editNoHP" placeholder="">
                    <div class="invalid-feedback errorEdit_no_hp">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="edit_email" id="editEmail" placeholder="">
                    <div class="invalid-feedback errorEdit_email">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editInstansi" class="form-label">Educational Institutions</label>
                    <select name="edit_instansi" class="custom-select" id="editInstansi">
                        <option value="" hidden></option>
                        <option value="School">School</option>
                        <option value="University">University</option>
                    </select>
                    <div class="invalid-feedback errorEdit_instansi">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="editNamaInstansi" class="form-label">Educational Institutions Name :</label>
                    <input type="text" class="form-control" name="edit_nama_instansi" id="editNamaInstansi" placeholder="">
                    <div class="invalid-feedback errorEdit_nama_instansi">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editNamaPembimbing" class="form-label">Name Of Supervising Teacher :</label>
                    <input type="text" class="form-control" name="edit_nama_pembimbing" id="editNamaPembimbing" placeholder="">
                    <div class="invalid-feedback errorEdit_nama_Pembimbing">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="editNoPembimbing" class="form-label">Supervising Teacher Phone :</label>
                    <input type="number" class="form-control" name="edit_no_pembimbing" id="editNoPembimbing" placeholder="">
                    <div class="invalid-feedback errorEdit_no_pembimbing">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombol-tutup-edit" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="tombolEdit">Update</button>
            </div>

        </div>
    </div>
</div>