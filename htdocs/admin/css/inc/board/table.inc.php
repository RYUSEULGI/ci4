<?php

include_once dirname(__FILE__) . '../../../../config/database.php';
include_once dirname(__FILE__) . '../../../../config/crypt.php';

header("Content-Type: application/json");

try {
    if (isset($_POST['delId'])) {
        $delId = mysqli_escape_string($conn, $_POST['delId']);

        delParticipant($conn, $delId);
    } else if (isset($_POST['approveId'])) {
        $approveId = mysqli_escape_string($conn, $_POST['approveId']);

        approveUpload($conn, $approveId);
    } else throw new Exception("no id data");
} catch (Exception $e) {
    echo $e->getMessage();
}

function getList($conn)
{
    $sql = "SELECT * FROM participant ORDER BY time desc";
    $res = mysqli_query($conn, $sql);
    $data = array();

    while ($participantList = mysqli_fetch_assoc($res)) {
        $data[] = $participantList;
    }
    $arr = array("list" => $data);
    echo json_encode($arr);
}

function delParticipant($conn, $id)
{

    $sql = "UPDATE participant
        SET status = false, del_time = NOW()
        WHERE id='" . $id . "'
    ";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo $res;
    } else {
        throw new Exception("delete error");
    }
}

function approveUpload($conn, $id)
{
    $sql = "UPDATE participant
        SET approve = true
        WHERE id='" . $id . "'
    ";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo $res;
    } else {
        throw new Exception("approve error");
    }
}
