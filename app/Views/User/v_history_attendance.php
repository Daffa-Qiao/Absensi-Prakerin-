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
                        <th class="text-center" style="min-width: 100px;">School Name</th>
                        <th class="text-center" style="min-width: 150px;">Full Name</th>
                        <th class="text-center" style="min-width: 150px;">Location</th>
                        <th class="text-center" style="min-width: 100px;">Attendance Image</th>
                        <th class="text-center" style="min-width: 100px;">Description</th>
                        <th class="text-center" style="min-width: 100px">Checkin</th>
                        <th class="text-center" style="min-width: 100px">Checkout</th>
                        <th class="text-center" style="min-width: 100px;">Status</th>
                        <th class="text-center" style="min-width: 180px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dataAbsen as $value) {
                        if ($value['status'] == 'Masuk') {
                            $status = 'hadir';
                        } else if ($value['status'] == 'Izin') {
                            $status = 'izin';
                        } else {
                            $status = 'sakit';
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