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
                        <th class="text-center" style="min-width: 100px;">Start Time</th>
                        <th class="text-center" style="min-width: 100px">Finish Time</th>
                        <th class="text-center" style="min-width: 200px">Description</th>
                        <th class="text-center" style="min-width: 120px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dataActivity as $value) {
                        if ($value['status'] == 'Progres') {
                            $status = 'progres';
                        } else if ($value['status'] == 'Closed') {
                            $status = 'closed';
                        }
                        ?>
                        <tr>
                            <td>
                                <?= $nomor; ?>
                            </td>
                            <td class="align-middle">
                                <div class="status <?= (isset($status)) ? $status : '' ?>">
                                    <?= $value['status']; ?>
                                </div>
                            </td>
                            <td>
                                <?= $nama_lengkap ?>
                            </td>
                            <td>
                                <?= $value['lokasi']; ?>
                            </td>
                            <td>
                                <?php if ($value['foto_absen'] != ''): ?>
                                    <img src="<?= base_url('uploadFoto/' . $value['foto_absen']) ?>" alt=""
                                        onclick="tampilkanPopup('<?= base_url('uploadFoto/' . $value['foto_absen']) ?>')">
                                <?php endif ?>
                            </td>
                            <td>
                                <?= $value['keterangan']; ?>
                            </td>
                            <td>
                                <?= $value['checkin_time']; ?>
                            </td>
                            <td>
                                <?= $value['checkout_time']; ?>
                            </td>
                            <td>
                                <?= tanggal_indo($value['waktu_absen']) ?>
                            </td>
                        </tr>
                        <?php
                        $nomor++;
                    } ?>
                </tbody>
            </table>
            <?= $pager->links('absensi', 'absensitable') ?>
        </div>
    </div>
</main>



<?= $this->endSection(); ?>