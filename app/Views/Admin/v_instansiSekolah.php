<?= $this->extend('Admin/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid pb-1 px-0">
    <!-- DataTales Example -->
    <!-- modal -->
    <?php include(APPPATH . 'Views/Admin/Modal/modalInstansi.php') ?>
    <!-- table -->
    <div class="title text-dark font-weight-bold px-1 rounded-top mt-5 pl-3"> List of School</div>
    <div class="wrapperCard h-100">
        <div class="row row-cols-1 py-3 mx-auto d-flex flex-row">
            <?php foreach ($dataInstansi as $v): ?>
            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                <div class="card text-white bg-gradient-warning mb-3 w-100" style="max-width: 22rem" id="box">
                    <div class="card-body d-flex ">
                        <div class="wrapper-img w-25 d-flex align-items-center">
                            <?php
                                $logo = $namaFile[$v->nama_instansi];
                                if ($logo == ''){
                                    $logo = 'sekolah.png';
                                }
                                ?>
                            <img src="<?= base_url('uploadFoto/' . $logo); ?>"
                                onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $logo); ?>')" class="instansi" />
                        </div>
                        <div class="wrapperP w-75">
                            <p class="card-text">
                                <?= $v->nama_instansi; ?>
                            </p>
                            <p class="card-text">
                                <?= $jumlahSiswa[$v->nama_instansi] ?>
                                Student
                            </p>
                            <p class="card-text">
                                <?= $v->instansi_pendidikan; ?>
                            </p>
                        </div>

                    </div>
                    <button type="button" class="btn btn-secondary bg-gradient-secondary" data-toggle="modal"
                        data-target="#modalInstansi" id="detail"
                        onclick="get_sekolah('<?= $v->nama_instansi; ?>')">Detail</button>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- end container-fluid -->

</div>
<!-- End of Main Content -->
<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if (session()->getFlashdata('swal_icon')): ?>
Swal.fire({
    icon: '<?= session()->getFlashdata('swal_icon'); ?>',
    title: '<?= session()->getFlashdata('swal_title'); ?>',
    showConfirmButton: false,
    timer: 1500
})
<?php endif; ?>

let display = document.getElementById("display_image");
let input = document.getElementById("logo");

input.addEventListener("change", () => {
    let reader = new FileReader();
    reader.readAsDataURL(input.files[0]);
    reader.addEventListener("load", () => {
        display.innerHTML =
            `<img src=${reader.result} alt='' width="200px" class="rounded" id="display_c" />`;
    });
});
</script>
<?= $this->endSection(); ?>