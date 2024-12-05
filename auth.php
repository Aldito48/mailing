<?php
    require "configure/connect.php";

    if (isset($_SESSION['user'])) {
        echo "<script>window.location='".base_url()."dashboard.php';</script>";
    } else {
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?=base_url()?>assets/css/auth.css?v=<?=time()?>" />
        <title>Mailing</title>
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>LOGIN</header>
                    <form method="POST" action="<?=base_url()?>process/access" autocomplete="on">
                        <div class="field input-field">
                            <input type="text" name="code" placeholder="User Code / NIK" class="input" autocomplete="on username" required>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="password" placeholder="Password" class="password" autocomplete="on current-password" required>
                            <i class="ri-eye-off-line eye-icon"></i>
                        </div>
                        <div class="form-link">
                            <a href="" class="forgot-link forgot-pass">Lupa password?</a>
                        </div>
                        <div class="field button-field">
                            <button type="submit" name="login">LOGIN</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Belum punya akun? <a href="" class="link signup-link">Signup</a></span>
                    </div>
                </div>
            </div>

            <div class="form signup">
                <div class="form-content">
                    <header>SIGNUP</header>
                    <form method="POST" action="<?=base_url()?>process/access">
                        <div class="field input-field">
                            <input type="text" name="code" placeholder="NIK" class="input" oninput="validateNumberInput(this)" required>
                        </div>
                        <div class="field input-field">
                            <input type="text" name="full_name" placeholder="Full Name" class="input" required>
                        </div>
                        <div class="field input-field">
                            <input type="text" name="contact" placeholder="No. WA (ex: 62xxxx)" class="input" oninput="validateNumberInput(this)" required>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="password" placeholder="Password" class="password" required>
                            <i class="ri-eye-off-line eye-icon"></i>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="confirm-password" placeholder="Confirm Password" class="confirm-password" required>
                            <i class="ri-eye-off-line c-eye-icon"></i>
                        </div>
                        <div class="field button-field">
                            <button type="submit" name="signup">SIGNUP</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Sudah punya akun? <a href="" class="link login-link">Login</a></span>
                    </div>
                </div>
            </div>

            <div class="form forgot">
                <div class="form-content">
                    <header>FORGOT PASS</header>
                    <form method="POST" action="<?=base_url()?>process/access">
                        <div class="field input-field">
                            <input type="text" name="code" placeholder="User Code / NIK" class="input" required>
                        </div>
                        <div class="field input-field">
                            <input type="text" name="contact" placeholder="No. WA (ex: 62xxxx)" class="input" oninput="validateNumberInput(this)" required>
                        </div>
                        <div class="field button-field">
                            <button type="submit" name="forgot">KIRIM OTP</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Kembali? <a href="" class="forgot-link login-link">Login</a></span>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?=base_url()?>assets/js/auth.js?v=<?=time()?>"></script>
    </body>
</html>
<?php
    }
?>