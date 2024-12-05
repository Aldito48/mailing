<?php
    require "../configure/connect.php";

    if (isset($_GET['query'])) {
        $searchTerm = mysqli_real_escape_string($con, $_GET['query']);
        $userRole = $_SESSION['role'];
        $query = "
            SELECT name, page, icon
            FROM tbl_menu
            WHERE is_active = 'YES'
              AND name LIKE '%$searchTerm%'
              AND JSON_CONTAINS(access, '\"$userRole\"')
        ";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $results = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
        echo json_encode($results);
    }
?>
