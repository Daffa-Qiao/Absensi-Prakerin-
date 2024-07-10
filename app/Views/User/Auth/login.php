<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/login.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fb6ebd8b45.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="containerTittle">
            <div class="wrapperImg">
                <img src="<?= base_url('admin') ?>/img/sekolah.png" />
                <h1>Absensi</h1>
            </div>
            <div class="wrapperTittle">
                <h2>Siswa/Mahasiswa</h2>
            </div>
        </div>
        <?php $validation = \Config\Services::validation() ?>
        <form action="<?= site_url('/login') ?>" method="post">
            <?php if (session()->getFlashdata("error")) { ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('error') ?>
            </div>
            <?php } ?>
            <?php if (session()->getFlashdata("success")) { ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success') ?>
            </div>
            <?php } ?>
            <?php if (isset($captcha)) { ?>
            <div class="alert alert-danger">
                <?php echo $captcha ?>
            </div>
            <?php } ?>

            <div class="containerInput">
                <div class="wrapperInput form-floating">
                    <input id="inputUsername"
                        class="form-control <?= ($validation->hasError('login_id')) ? 'is-invalid' : '' ?>" type="text"
                        name="login_id" placeholder="Username :"
                        value="<?= session()->getFlashdata('login_id'), set_value('login_id') ?>" required />
                    <label for="inputUsername">Username atau Email</label>
                    <div class="invalid-feedback">
                        <?= $validation->getError('login_id') ?>
                    </div>
                </div>
                <div class="wrapperInput form-floating">
                    <input id="inputPassword"
                        class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                        type="password" name="password" placeholder="password :"
                        value="<?= session()->getFlashdata('password'), set_value('password') ?>" required />
                    <label for="inputPassword">Password</label>
                    <div class="invalid-feedback">
                        <?= $validation->getError('password') ?>
                    </div>
                </div>

                <div class="wrapperCF px-1 my-2 pb-1">
                    <div class="wrapperCb">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Show Password
                            </label>
                        </div>
                    </div>
                    <div class="forget">
                        <a href="<?= base_url('/forgetpassword') ?>">Lupa Password ?</a>
                    </div>
                </div>
		<!-- <div class="g-recaptcha mt-1" data-sitekey="<?= getenv('SITEKEY'); ?>"></div> -->
                <div class="containerFooter">
                    <input type="submit" name="submit" class="login" value="Login">
                    <div class="wrapperText">
                        <span>Belum memiliki Akun?</span>
                        <a href="<?= base_url('/register'); ?>">Buat Akun</a>
                    </div>
                </div>
        </form>
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
    let lihat = document.getElementById("flexCheckDefault")
    lihat.addEventListener("click", function() {
        let pw = document.querySelector("input#inputPassword")
        if (pw.type === "password") {
            pw.type = "text";
        } else {
            pw.type = "password";
        }
    });
    </script>
</body>

</html>
