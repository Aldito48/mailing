<?php
    require "configure/connect.php";

    session_destroy();
    echo "<script>window.location='".base_url()."auth.php';</script>";
?>