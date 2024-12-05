<?php
    require __DIR__ . "/env.php";

    date_default_timezone_set('Asia/Jakarta');
    session_start();

    $host = $db_host;
    $user = $db_user;
    $pass = $db_pass;
    $db   = $db_name;
    $con  = mysqli_connect($host, $user, $pass, $db);

    mysqli_select_db($con, $db);

    function base_url() {
        global $mode;

        if ($mode == 'dev') {
            return 'http://localhost/mailing/';
        } else if ($mode == 'prod') {
            return '';
        }
    }
?>