<?php
    require "configure/connect.php";

    if (isset($_SESSION['user'])) {
        if (time() - $_SESSION['login_time'] > 864000) {
            echo "<script>window.location='".base_url()."logout.php';</script>";
        }
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <?php include "layout/headPage.php"; ?>
    </head>
    <body>
        <?php include "layout/sidebar.php"; ?>

        <div class="main">
            <?php include "layout/topbar.php"; ?>

            <div class="content">
                <h1 class="content-title">Surat Masuk</h1>
            </div>
        </div>

        <?php include "layout/scriptPage.php"; ?>
    </body>
</html>
<?php
    } else {
        echo "<script>window.location='".base_url()."auth.php';</script>";
    }
?>