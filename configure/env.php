<?php
    $mode = 'dev'; // dev || prod

    if ($mode == 'dev') {
        $db_host    = 'localhost';
        $db_user    = 'root';
        $db_pass    = '';
        $db_name    = 'db_mailing';
        $wa_api_url = 'https://tegal.wablas.com/api';
        $wa_token   = 'wqYETnV9M57dYT7E8hERyEu7LbDDi3X89s0tLHZubw6UYGuRkmN6nnBe51YTJPIC';
    } else if ($mode == 'prod') {
        $db_host    = '';
        $db_user    = '';
        $db_pass    = '';
        $db_name    = '';
        $wa_api_url = '';
        $wa_token   = '';
    } else {
        echo "Connection error!";
    }
?>