<!-- Modal Super User -->
<div class="modal fade" id="modalsuperAdmin" tabindex="-1" aria-labelledby="modalsuperAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalsuperAdminLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <!-- input ID -->
                <input type="hidden" id="superId" name="super_id">
                <!-- data nim/nis -->
                <input type="hidden" name="dataNim_Nis" id="dataNim_Nis">
                <!-- FOTM INPUT DATA -->
                <div class="mb-3">
                    <label for="superNamaLengkap" class="form-label">Name</label>
                    <input type="text" class="form-control" name="super_nama_lengkap" id="superNamaLengkap" placeholder="">
                    <div class=" invalid-feedback errornama_lengkap">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="superNimNis" class="form-label">NIM / NIS</label>
                    <input type="text" class="form-control" name="super_nim_nis" id="superNimNis" placeholder="">
                    <div class="invalid-feedback errornim_nis">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="superUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="super_username" id="superUsername" placeholder="">
                    <div class="invalid-feedback errorusername">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="superEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="super_email" id="superEmail" placeholder="">
                    <div class="invalid-feedback erroremail">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="superPassword" class="form-label">Password</label>
                    <input type="text" class="form-control" name="super_password" id="superPassword" placeholder="">
                    <div class="invalid-feedback errorpassword">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="superNoHP" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" name="super_no_hp" id="superNoHP" placeholder="">
                    <div class="invalid-feedback errorno_hp">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="superStatus" class="form-label">Change Status</label>
                    <select name="super_status" class="custom-select" id="superStatus">
                        <option value="Good">Good</option>
                        <option value="Verbal Warning">Verbal Warning</option>
                        <option value="Written Agreement">Written Agreement</option>
                        <option value="Terminated">Terminated</option>
                    </select>
                    <div class="invalid-feedback errorstatus">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="superRole" class="form-label">Change Role</label>
                    <select name="super_role" class="custom-select" id="superRole">
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    <div class="invalid-feedback errorrole">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombol-tutup" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="tombolSave">Submit</button>
            </div>
        </div>
    </div>
</div>