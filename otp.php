<?php
    require "configure/connect.php";

    if (isset($_SESSION['user'])) {
        echo "<script>window.location='".base_url()."dashboard.php';</script>";
    } else {
        if (isset($_POST['code']) && isset($_POST['otp']) && isset($_POST['fpass'])) {
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?=base_url()?>assets/css/other.css?v=<?=time()?>" />
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
                        <input type="hidden" name="otp" value="<?=$_POST['otp']?>">
                        <input type="hidden" name="fpass" value="<?=$_POST['fpass']?>">
                        <div class="field input-field">
                            <input type="text" name="cotp" placeholder="OTP" class="input" oninput="validateNumberInput(this)" required>
                        </div>
                        <div class="field button-field">
                            <button type="submit" name="sendOTP">KONFIRMASI OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <script src="<?=base_url()?>assets/js/other.js?v=<?=time()?>"></script>
    </body>
</html>
<?php
        } else {
            echo "<script>window.location='".base_url()."auth.php';</script>";
        }
    }
?>