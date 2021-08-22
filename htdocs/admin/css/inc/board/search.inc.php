<?php

include_once dirname(__FILE__) . '../../../../config/database.php';
include_once dirname(__FILE__) . '../../../../config/crypt.php';

header("Content-Type: application/json");

$filtered = array_map(array($conn, 'real_escape_string'), $_POST);
$category = $filtered['category'];
$keyword = $filtered['keyword'];

try {
    chkInput($category, $keyword);
} catch (Exception $e) {
    echo $e->getMessage();
}

function chkInput($category, $keyword)
{
    if (!(empty($category) || empty($keyword))) {
        echo true;
    } else {
        throw new Exception("fill in all data");
    }
}
