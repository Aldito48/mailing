<?php
    $mode = 'dev'; // dev || prod
    $gateway = 'Wablas'; // Wablas || Fonnte

    if ($mode == 'dev') {
        $db_host    = 'localhost';
        $db_user    = 'root';
        $db_pass    = '';
        $db_name    = 'db_mailing';
    } else if ($mode == 'prod') {
        $db_host    = '';
        $db_user    = '';
        $db_pass    = '';
        $db_name    = '';
    } else {
        echo "Connection error!";
    }

    if ($gateway == 'Wablas') {
        $wa_api_url = 'https://tegal.wablas.com/api';
        $wa_token   = 'wqYETnV9M57dYT7E8hERyEu7LbDDi3X89s0tLHZubw6UYGuRkmN6nnBe51YTJPIC';
    } else if ($gateway == 'Fonnte') {
        $wa_api_url = 'https://api.fonnte.com';
        $wa_token   = 'C2U2tTUPK4SZZ7RVwbzo';
    } else {
        echo "Gateway doesn't exist!";
    }
?>