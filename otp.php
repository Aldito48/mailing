<?php
    require "configure/connect.php";

    if (isset($_SESSION['user'])) {
        echo "<script>window.location='".base_url()."dashboard.php';</script>";
    } else {
        if (isset($_POST['code']) && isset($_POST['contact']) && isset($_POST['otp']) && isset($_POST['otp_time']) && isset($_POST['fpass'])) {
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?=base_url()?>assets/css/other.css?v=<?=time()?>" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>favicon/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>favicon/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>favicon/favicon-16x16.png" />
        <link rel="manifest" href="<?=base_url()?>site.webmanifest" />
        <title>Mailing</title>
    </head>
    <body>
        <section class="container forms">
            <div class="form otp">
                <div class="form-content">
                    <header>OTP</header>
                    <form method="POST" action="<?=base_url()?>process/access">
                        <div class="field input-field">
                            <input type="text" name="code" placeholder="User Code / NIK" value="<?=$_POST['code']?>" class="input" readonly required>
                        </div>
                        <input type="hidden" name="contact" value="<?=$_POST['contact']?>">
                        <input type="hidden" name="otp" value="<?=$_POST['otp']?>">
                        <input type="hidden" name="otp_time" value="<?=$_POST['otp_time']?>">
                        <input type="hidden" name="fpass" value="<?=$_POST['fpass']?>">
                        <div class="field input-field">
                            <input type="text" name="cotp" placeholder="OTP" class="input" oninput="validateNumberInput(this)" required>
                        </div>
                        <div class="field button-field">
                            <button type="submit" name="confirmOTP">KONFIRMASI OTP</button>
                        </div>
                    </form>
                    <span class="resend">
                        <small>Tidak Menerima OTP?</small>
                        <button id="resendOTP" name="resendOTP" type="button" disabled></button>
                    </span>
                </div>
            </div>
        </section>

        <script src="<?=base_url()?>assets/js/other.js?v=<?=time()?>"></script>
        <script>
            var otpTimeString = document.querySelector('input[name="otp_time"]').value;
            var otpTime = new Date(otpTimeString).getTime() / 1000;
            var currentTime = Math.floor(Date.now() / 1000);
            var timeElapsed = currentTime - otpTime;
            var resendButton = document.getElementById('resendOTP');

            if (timeElapsed < 30) {
                resendButton.disabled = true;
                var countdownTime = 30 - timeElapsed;
                resendButton.innerText = 'Tunggu ' + countdownTime + ' detik';
                var countdownInterval = setInterval(function() {
                    countdownTime--;
                    resendButton.innerText = 'Tunggu ' + countdownTime + ' detik';
                    if (countdownTime <= 0) {
                        clearInterval(countdownInterval);
                        resendButton.disabled = false;
                        resendButton.innerText = 'Resend OTP';
                    }
                }, 1000);
            } else {
                resendButton.disabled = false;
                resendButton.innerText = 'Resend OTP';
            }

            resendButton.addEventListener('click', function() {
                var code = document.querySelector('input[name="code"]').value;
                var contact = document.querySelector('input[name="contact"]').value;
                var fpass = document.querySelector('input[name="fpass"]').value;
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?=base_url()?>process/access';
                var inputResendOTP = document.createElement('input');
                inputResendOTP.type = 'hidden';
                inputResendOTP.name = 'resendOTP';
                inputResendOTP.value = 'resendOTP';
                form.appendChild(inputResendOTP);
                var inputCode = document.createElement('input');
                inputCode.type = 'hidden';
                inputCode.name = 'code';
                inputCode.value = code;
                form.appendChild(inputCode);
                var inputContact = document.createElement('input');
                inputContact.type = 'hidden';
                inputContact.name = 'contact';
                inputContact.value = contact;
                form.appendChild(inputContact);
                var inputFpass = document.createElement('input');
                inputFpass.type = 'hidden';
                inputFpass.name = 'fpass';
                inputFpass.value = fpass;
                form.appendChild(inputFpass);
                document.body.appendChild(form);
                form.submit();
            });
        </script>
    </body>
</html>
<?php
        } else {
            echo "<script>window.location='".base_url()."auth.php';</script>";
        }
    }
?>