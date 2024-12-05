<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See https://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - https://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
require "env.php";

$table = '';

if (isset($_GET['table'])) {
    if ($_GET['table'] == 'mail_in') {
        $table = 'tbl_mail_in';
    } else if ($_GET['table'] == 'mail_out') {
        $table = 'tbl_mail_out';
    }  else {
        die("Invalid table name");
    }
}

$primaryKey = 'id';

switch ($table) {
    case 'tbl_mail_in':
        $columns = array(
            array( 'db' => 'sender', 'dt' => 0 ),
            array( 'db' => 'mail_type', 'dt' => 1 ),
            array( 'db' => 'req_date', 'dt' => 2 ),
            array( 'db' => 'info', 'dt' => 3 ),
            array( 'db' => 'status', 'dt' => 4 ),
            array( 'db' => 'reason', 'dt' => 5 ),
            array( 'db' => 'id', 'dt' => 6 )
        );
        $where = null;
        break;

    case 'tbl_mail_out':
        $columns = array(
            array( 'db' => 'mail_code', 'dt' => 0 ),
            array( 'db' => 'receiver', 'dt' => 1 ),
            array( 'db' => 'target', 'dt' => 2 ),
            array( 'db' => 'file', 'dt' => 3 ),
            array( 'db' => 'out_date', 'dt' => 4 ),
            array( 'db' => 'id', 'dt' => 5 )
        );
        $where = null;
        break;

    default:
        die("Invalid table configuration");
}

$sql_details = array(
    'user' => $db_user,
    'pass' => $db_pass,
    'db'   => $db_name,
    'host' => $db_host
);

require( '../assets/ssp.class.php' );

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
);