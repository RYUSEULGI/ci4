<?php

include_once './config/database.php';

$sql = "SELECT * FROM information";

$res = mysqli_query($db, $sql);
$row = mysqli_fetch_array($res);

while ($row) {
    echo $row['name'];
}
