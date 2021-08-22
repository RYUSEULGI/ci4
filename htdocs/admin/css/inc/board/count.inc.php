<?php

include_once dirname(__FILE__) . '../../../../config/database.php';

header("Content-Type: application/json");

$getTotal = "SELECT COUNT(*) AS cnt_total FROM participant";
$getDate = "SELECT DATE(time) AS date,
        COUNT(*) AS cnt_info
        FROM participant
        GROUP BY DATE(time);
    ";

$totalArr = getData($conn, $getTotal);
$dateArr = getData($conn, $getDate);
$arr = array_merge($totalArr, $dateArr);

echo json_encode($arr);

function getData($conn, $sql)
{
    $res = mysqli_query($conn, $sql);
    $data = array();

    while ($cnt = mysqli_fetch_assoc($res)) {
        $data[] = $cnt;
    }

    return $data;
}
