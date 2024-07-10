<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/verifikasi.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Email Verification</h3>
        </div>
        <?php $validation = \Config\Services::validation() ?>
        <div class="containerInput">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-warning">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif ?>
            <div class=" wrapperJudul">
                <label>Input OTP code for account verification</label>
            </div>
            <form action="<?= site_url('/verifikasi'); ?>" method="post">
                <div class="mb-3 mt-2">
                    <div class="form-floating">
                        <input type="text" name="token" id="inputOTP" class="form-control"
                            style="background-color: #d9d9d9; border-radius: 15px;" placeholder="Masukkan OTP" required>
                        <label for="inputOTP">Input OTP code</label>
                    </div>
                </div>
                <div class=" d-flex justify-content-between">
                    <a href="<?= site_url('/kirim_ulang'); ?>" id="countdownLink" name="kirim_ulang" class="resendLink"
                        style=" color: grey;">Send OTP</a>
                    <div class="d-grid w-90">
                        <input type="submit" name="verifikasi" id="verifikasiBtn" class="btn btn-primary"
                            value="Verfikasi" style="background: #19aaea; border: none;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    function startCountdown(durationSeconds, element) {
        var countdown;

        // Cek apakah ada nilai countdown di localStorage
        var savedCountdown = localStorage.getItem('countdown');
        if (savedCountdown !== null) {
            countdown = parseInt(savedCountdown, 10);
        } else {
            countdown = durationSeconds;
        }

        function updateCountdown() {
            if (countdown >= 0) {
                element.innerText = countdown + " detik tersisa";
                element.style.color = "red";
            }

            if (countdown === 0) {
                clearInterval(countdownInterval);
                element.innerText = "Kirim OTP";
                element.style.color = "grey";
                element.style.pointerEvents = "auto"; // Aktifkan kembali tautan setelah waktu habis
            }

            if (countdown < 0) {
                clearInterval(countdownInterval);
                element.innerText = "Kirim OTP";
                element.style.color = "grey";
                element.style.pointerEvents = "auto"; // Aktifkan kembali tautan setelah waktu habis
            }

            countdown--;

            // Simpan nilai countdown di localStorage setiap kali diupdate
            localStorage.setItem('countdown', countdown.toString());
        }

        // Memanggil fungsi updateCountdown setiap detik
        var countdownInterval = setInterval(updateCountdown, 1000);
        element.style.pointerEvents = "none"; // Matikan tautan selama hitung mundur
    }

    document.addEventListener("DOMContentLoaded", function () {
        var countdownLink = document.getElementById("countdownLink");

        countdownLink.addEventListener("click", function (event) {
            // Hapus nilai countdown dari localStorage saat tombol diklik untuk mereset countdown
            localStorage.removeItem('countdown');
            startCountdown(60, countdownLink);
        });

        // Cek apakah countdown sedang berlangsung saat halaman dimuat
        var savedCountdown = localStorage.getItem('countdown');
        if (savedCountdown !== null) {
            startCountdown(parseInt(savedCountdown, 10), countdownLink);
        }
    });


</script>

</html>