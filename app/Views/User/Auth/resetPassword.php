<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/resetpassword.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Reset Password</h3>
        </div>
        <?php $validation = \Config\Services::validation() ?>
        <div class="containerInput">
            <form action="<?= route_to('/resetpassword'); ?>" method="post">
                <div class=" wrapperJudul">
                    <label>Masukkan Password Baru</label>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif ?>

                <div class="wrapperInput form-floating">
                    <input id="inputPassword"
                        class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                        type="password" name="password" placeholder="" value="<?= set_value('password'); ?>" />
                    <label for="inputPassword">Password</label>
                    <div class="invalid-feedback">
                        <?= ($validation->getError('password')); ?>
                    </div>
                </div>
                <div class="wrapperInput form-floating">
                    <input id="inputKonfirmasiPassword"
                        class="form-control <?= ($validation->hasError('konfirmasi_password')) ? 'is-invalid' : '' ?>"
                        type="password" name="konfirmasi_password" placeholder=""
                        value="<?= session()->getFlashdata('email'); ?>" />
                    <label for="inputKonfirmasiPassword">Konfirmasi Password</label>
                    <div class="invalid-feedback">
                        <?= ($validation->getError('konfirmasi_password')); ?>
                    </div>
                </div>
        </div>

        <div class="footer d-flex align-items-center justify-content-between mt-4">
            <a class="small" href="<?= base_url('/login') ?>">Kembali Ke Login</a>
            <input type="submit" name="submit" class="button-reset" value="Reset Password">
        </div>
        </form>
    </div>
</body>

</html>