<?php

include_once '../config/database.php';

$filtered = array(
    'name' => mysqli_real_escape_string($conn, $_POST['name']),
    'phone' => mysqli_real_escape_string($conn, $_POST['phone']),
    'addr1' => mysqli_real_escape_string($conn, $_POST['addr1']),
    'addr2' => mysqli_real_escape_string($conn, $_POST['addr2']),
    'addr3' => mysqli_real_escape_string($conn, $_POST['addr3']),
    'device' => mysqli_real_escape_string($conn, $_POST['device']),
    'agree' => mysqli_real_escape_string($conn, $_POST['agree']),
);

$sql = "INSERT INTO information 
    (name, phone, addr1, addr2, addr3, device, agree, time) 
    VALUES (
        '{$filtered['name']}',
        '{$filtered['phone']}',
        '{$filtered['addr1']}',
        '{$filtered['addr2']}',
        '{$filtered['addr3']}',
        '{$filtered['device']}',
        '{$filtered['agree']}',
        NOW()
    );
";

$res = mysqli_query($conn, $sql);
