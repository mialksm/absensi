<?php

if (empty($connection)) {
    header('location:./404');
} else {
    $query_isp   = "SELECT * FROM isp limit 1";
    $result_isp  = mysqli_query($connection, $query_isp);
    $myip = $_SERVER['REMOTE_ADDR'];
    while ($row = mysqli_fetch_assoc($result_isp)) {
        echo ($row['isp_name']);
        echo " (" . $myip . ")";
    }
}
