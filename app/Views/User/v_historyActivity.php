<?= $this->extend('User/Layout/v_template'); ?>

<?= $this->section('content'); ?>

<!-- Template Main Content -->
<main class="table">
    <div class="card body m-1">
        <div class="table__body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="min-width: 50px;">No</th>
                        <th class="text-center" style="min-width: 200px;">Name</th>
                        <th class="text-center" style="min-width: 100px;">Date</th>
                        <th class="text-center" style="min-width: 150px;">Location</th>
                        <th class="text-center" style="min-width: 150px;">Documentation</th>
                        <th class="text-center" style="min-width: 200px">Description</th>
                        <th class="text-center" style="min-width: 100px;">Start Time</th>
                        <th class="text-center" style="min-width: 100px">Finish Time</th>
                        <th class="text-center" style="min-width: 120px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dataActivity as $value) {
                        if ($value['status'] == 'Progress') {
                            $status = 'proses';
                        } else if ($value['status'] == 'Closed') {
                            $status = 'selesai';
                        } else {
                            $status = 'proses';
                        }
                    ?>
                        <tr>
                            <td>
                                <?= $nomor; ?>
                            </td>
                            <td>
                                <?= $nama_lengkap ?>
                            </td>
                            <td>
                                <?= tanggal_indo($value['waktu_laporan']) ?>
                            </td>
                            <td>
                                <?= $value['lokasi']; ?>
                            </td>
                            <td>
                                <?php if ($value['foto_laporan'] != ''): ?>
                                    <img src="<?= base_url('uploadFoto/' . $value['foto_laporan']) ?>" alt=""
                                        onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $value['foto_laporan']) ?>')">
                                <?php endif ?>
                            </td>
                            <td>
                                <?= $value['kegiatan']; ?>
                            </td>
                            <td>
                                <?= $value['waktu_mulai']; ?>
                            </td>
                            <td>
                                <?php
                                if ($value['waktu_selesai'] == null) {
                                    $id = $value['id_laporan'];
                                    echo '<a class="btn btn-danger btn-circle mb-1"onclick="finish(' . $id . ')">Finish Time</a>';
                                } else {
                                    echo $value['waktu_selesai'];
                                }
                                ?>
                            </td>
                            <td class="align-middle">
                                <div class="status <?= (isset($status)) ? $status : '' ?>">
                                    <?= $value['status']; ?>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $nomor++;
                    } ?>
                </tbody>
            </table>
            <?= $pager->links('laporan', 'absensitable') ?>
        </div>
    </div>
</main>



<?= $this->endSection(); ?>