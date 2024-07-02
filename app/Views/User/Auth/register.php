<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/register.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="title">
            <h2>Register</h2>
        </div>
        <?php $validator = \Config\Services::validation() ?>
        <form action="<?= route_to('/register') ?>" method="post">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>
            <?php if (isset($captcha)): ?>
                <div class="alert alert-danger">
                    <?= $captcha ?>
                </div>
            <?php endif ?>
            <div class="containerInput">
                <div class="wrapperInput form-floating">
                    <input id="inputUsername"
                        class="form-control <?= ($validator->hasError('username')) ? 'is-invalid' : '' ?>" type="text"
                        name="username" placeholder="Masukkan Username" value="<?= set_value('username') ?>" required />
                    <label class="form-label" for="inputUsername">Username</label>
                    <div class="invalid-feedback">
                        <?php if (isset($validation['username'])): ?>
                            <?= $validation['username']; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="wrapperInput form-floating">
                    <input id="inputEmail"
                        class="form-control <?= ($validator->hasError('email')) ? 'is-invalid' : '' ?>" type="email"
                        name="email" placeholder="Masukkan Email" value="<?= set_value('email') ?>" required />
                    <label for="inputEmail">Email</label>
                    <div class="invalid-feedback">
                        <?php if (isset($validation['email'])): ?>
                            <?= $validation['email']; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="wrapperInput form-floating">
                    <input id="inputPassword"
                        class="form-control <?= ($validator->hasError('password')) ? 'is-invalid' : '' ?>"
                        type="password" name="password" placeholder="Masukkan Password"
                        value="<?= set_value('password'); ?>" required />
                    <label for="inputPassword">Password</label>
                    <div class="invalid-feedback">
                        <?php if (isset($validation['password'])): ?>
                            <?= $validation['password']; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="wrapperInput form-floating">
                    <input id="inputPasswordKonf"
                        class="form-control <?= ($validator->hasError('konfirmasi_password')) ? 'is-invalid' : '' ?>"
                        type="password" name="konfirmasi_password" placeholder="Masukkan Password" required />
                    <label for="inputPasswordKonf">Konfirmasi Password</label>
                    <div class="invalid-feedback">
                        <?php if (isset($validation['konfirmasi_password'])): ?>
                            <?= $validation['konfirmasi_password']; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <!-- <div class="wrapperCb"> -->
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Tampilkan Password
                </label>
            </div>
            <!-- </div> -->
            <!-- <div class="g-recaptcha mt-2" data-sitekey="<?= getenv('SITEKEY'); ?>"></div> -->

            <div class="containerFooter">
                <input type="submit" name="submit" class="login" value="Register">
                <div class="wrapperText">
                    <span>Sudah memiliki akun ?</span>
                    <a href="<?= base_url('/login'); ?>">Login</a>
                </div>
            </div>
        </form>
    </div>
</body>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    let lihat = document.getElementById("flexCheckDefault")
    lihat.addEventListener("click", function () {
        let pw1 = document.getElementById("inputPassword")
        let pw2 = document.getElementById("inputPasswordKonf")
        if (pw1.type == "password" && pw2.type == "password") {
            pw1.type = "text";
            pw2.type = "text";
        } else {
            pw1.type = "password";
            pw2.type = "password";
        }
    });
</script>

</html>