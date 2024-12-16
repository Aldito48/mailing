<?php
    require "configure/connect.php";

    if (isset($_SESSION['user'])) {
        echo "<script>window.location='".base_url()."dashboard.php';</script>";
    } else {
        if (isset($_POST['code']) && isset($_POST['otp']) && $_POST['fpass'] == 'true') {
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
            <div class="form newpass">
                <div class="form-content">
                    <header>NEW PASSWORD</header>
                    <form method="POST" action="<?=base_url()?>process/access">
                        <div class="field input-field">
                            <input type="text" name="code" placeholder="User Code / NIK" value="<?=$_POST['code']?>" class="input" readonly required>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="password" placeholder="New Password" class="password" required>
                            <i class="ri-eye-off-line eye-icon"></i>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="confirm-password" placeholder="Confirm New Password" class="confirm-password" required>
                            <i class="ri-eye-off-line c-eye-icon"></i>
                        </div>
                        <div class="field button-field">
                            <button type="submit" name="sendPass">EDIT PASSWORD</button>
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