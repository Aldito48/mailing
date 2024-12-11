<?php
    $mode = "dev"; // dev || prod
    $gateway = "Fonnte"; // Wablas || Fonnte

    // Database
    if ($mode == "dev") {
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "db_mailing";
    } else if ($mode == "prod") {
        $db_host = "";
        $db_user = "";
        $db_pass = "";
        $db_name = "";
    } else {
        echo "Connection DB error!";
    }

    // WhatsApp
    if ($gateway == "Wablas") {
        $wa_api_url = "https://tegal.wablas.com/api";
        $wa_token   = "wqYETnV9M57dYT7E8hERyEu7LbDDi3X89s0tLHZubw6UYGuRkmN6nnBe51YTJPIC";
    } else if ($gateway == "Fonnte") {
        $wa_api_url = "https://api.fonnte.com";
        $wa_token   = "C2U2tTUPK4SZZ7RVwbzo";
    } else {
        echo "Gateway WhatsApp error!";
    }

    // Cloudinary
    $cloudName      = "dvuw3kx8o";
    $api_key        = "388461445489799";
    $api_secret     = "kr6lZIKfUfZjFswpi0_fN9N20e4";
    $url_cloudinary = "https://api.cloudinary.com/v1_1/$cloudName/image";
?>