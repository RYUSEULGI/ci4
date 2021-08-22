<?php

include_once dirname(__FILE__) . '/../../config/database.php';

header("Content-Type: application/json");

$userInfo = array_map(array($conn, 'real_escape_string'), $_POST);

chkInput($userInfo['username'], $userInfo['password'], $userInfo['rpassword']);
validateUsername($conn, $userInfo['username']);
validatePw($userInfo['password'], $userInfo['rpassword']);
createUser($conn, $userInfo['username'], $userInfo['password']);

function chkInput($username, $password, $rpassword)
{
    if (!(empty($username) || empty($password) || empty($rpassword))) {
        return true;
    } else {
        echo "fill in all inputs";
        throw new Exception("fill in all inputs");
    }
}

function validateUsername($conn, $username)
{
    $sql = "SELECT * FROM user
            WHERE username = '" . $username . "' 
            ";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($res);

    if (!$row) {
        return true;
    } else {
        echo "already exist the username";
        throw new Exception("already exist the username");
    }
}

function validatePw($password, $rpassword)
{
    if ($password === $rpassword) {
        return true;
    } else {
        echo "password is not the same";
        throw new Exception("password is not the same");
    }
}

function createUser($conn, $username, $password)
{
    $encryptPw = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, password, time) 
            VALUES (
            '{$username}',
            '{$encryptPw}',
            NOW());
        ";
    $res = mysqli_query($conn, $sql);

    echo $res;
}
