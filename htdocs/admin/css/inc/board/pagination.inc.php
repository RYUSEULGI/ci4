<?php

include_once dirname(__FILE__) . '../../../../config/database.php';
include_once dirname(__FILE__) . '../../../../config/crypt.php';

header("Content-Type: application/json");

try {
    $current = mysqli_real_escape_string($conn, $_POST['page']);

    if (isset($_POST['listNum'])) {
        $postOnePage = mysqli_real_escape_string($conn, $_POST['listNum']);
    } else {
        $postOnePage = 3;
    }

    $firstIdx = "";
    $printPage = printPage($conn, $current, $postOnePage);
    $totalIdx = totalIdx($conn, $postOnePage);
    $pageArray = pageArray($totalIdx['totalPageNum'], $current);
    $indexArray = indexArray($postOnePage, $current, $totalIdx['totalIdx']);
    $arr = array_merge($printPage, $pageArray, $indexArray);

    echo json_encode($arr);
} catch (Exception $e) {
    echo $e->getMessage();
}

function printPage($conn, $current, $postOnePage)
{
    $sql = getSearchData($conn, $current, $postOnePage);
    $res = mysqli_query($conn, $sql);

    while ($currentIdx = mysqli_fetch_assoc($res)) {
        $data[] = $currentIdx;
    }

    if (empty($data)) {
        throw new Exception("no data");
    } else {
        foreach ($data as $key => $entry) {
            $crypt = new Crypt();
            $decryptName = $crypt->decrypt($data[$key]['name']);
            $data[$key]['name'] = $decryptName;
        }
    }
    return array("list" => $data);
}

function totalIdx($conn, $postOnePage)
{
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);;
    $select = mysqli_real_escape_string($conn, $_POST['select']);

    if (!empty($keyword)) {

        if ($category === "name") {
            $crypt = new Crypt();
            $keyword = $crypt->encrypt($keyword);
        }

        $sql = "SELECT * FROM participant 
        WHERE $category LIKE '%$keyword%'
        ORDER BY id desc
        ";
    } else if (!empty($select)) {
        $sql = "SELECT * FROM participant 
        WHERE type='" . $select . "'
        ORDER BY time desc
        ";
    } else {
        $sql = "SELECT * FROM participant ORDER BY id desc";
    }
    $res = mysqli_query($conn, $sql);
    $totalIdx = mysqli_num_rows($res);
    $totalPageNum = ceil($totalIdx / $postOnePage);

    return array("totalIdx" => $totalIdx, 'totalPageNum' => $totalPageNum);
}

function getSearchData($conn, $current, $postOnePage)
{

    $firstIdx = ($current - 1) * $postOnePage;

    if (isset($_POST['keyword'])) {

        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);;

        if ($category === "name") {
            $crypt = new Crypt();
            $keyword = $crypt->encrypt($keyword);
        }

        $sql = "SELECT * FROM participant 
                WHERE $category LIKE '%$keyword%'
                ORDER BY id desc
                LIMIT $firstIdx, $postOnePage
            ";
    } else if (isset($_POST['select'])) {

        $select = mysqli_real_escape_string($conn, $_POST['select']);

        $sql = "SELECT * FROM participant 
            WHERE type='" . $select . "'
            ORDER BY time desc
            LIMIT $firstIdx, $postOnePage
        ";
    } else {
        $sql = "SELECT * FROM participant 
            ORDER BY id desc 
            LIMIT $firstIdx, $postOnePage
        ";
    }
    return $sql;
}

function pageArray($totalPageNum, $current)
{
    if ($totalPageNum > 5) {
        if ($current < 5) {
            for ($i = 1; $i <= 5; $i++) {
                $pageArr[] = $i;
            }
            $pageArr[] = '...';
            $pageArr[] = $totalPageNum;
        } else {
            $end = $totalPageNum - 4;

            if ($current > $end) {
                $pageArr[] = 1;
                $pageArr[] = '...';
                for ($i = $end; $i <= $totalPageNum; $i++) {
                    $pageArr[] = $i;
                }
            } else {
                $pageArr[] = 1;
                $pageArr[] = '...';
                for ($i = $current - 1; $i <= $current + 1; $i++) {
                    $pageArr[] = $i;
                }
                $pageArr[] = '...';
                $pageArr[] = $totalPageNum;
            }
        }
    } else {
        for ($i = 1; $i <= $totalPageNum; $i++) {
            $pageArr[] = $i;
        }
    }
    return array("page" => $pageArr, "current" => $current);
}

function indexArray($postOnePage, $current, $totalDataNum)
{
    if ($current === "1") {
        for ($i = 0; $i < $postOnePage; $i++) {
            $indexArr[] = $totalDataNum--;
        }
    } else {
        $totalDataNum = $totalDataNum - ($postOnePage * ($current - 1));

        for ($i = 0; $i < $postOnePage; $i++) {
            $indexArr[] = $totalDataNum--;
        }
    }
    return array("idx" => $indexArr);
}
