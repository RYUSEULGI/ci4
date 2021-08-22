<?php

include_once dirname(__FILE__) . '../../../../config/database.php';

$exportExcel = mysqli_escape_string($conn, $_POST['csv']);

if (isset($exportExcel)) {
    $fname = "fname";

    header('Content-Type: text/csv; charset=UTF-8;');
    header('Content-Disposition: attachment; filename="' . $fname . '_' . date('ymd') . '.csv' . '"');
    header('Expires: 0');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: private, no-transform, no-store, must-revalidate');

    echo "\xEF\xBB\xBF";

    $output = fopen("php://output", "w");
    fputcsv($output, array('No', '이름', '타입', '텍스트', 'IP주소', '파일승인여부', '파일업로드여부', '파일이름', '참여시간', '삭제상태', '삭제시간'));

    $sql = "SELECT * FROM participant ORDER BY time desc";
    $applicationList = mysqli_query($conn, $sql);

    foreach ($applicationList as $application) {
        fputcsv($output, $application);
    }
    fclose($output);
} else {
    echo "export error";
}
