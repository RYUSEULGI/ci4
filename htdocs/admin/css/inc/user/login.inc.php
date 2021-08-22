<?php

include_once dirname(__FILE__) . '../../../../config/database.php';

$filtered = array_map(array($conn, 'real_escape_string'), $_POST);

chkInput($filtered['username'], $filtered['password']);
chkPw($conn, $filtered['username'], $filtered['password']);

function chkInput($username, $password)
{
    if (!(empty($username) || empty($password))) {
        return true;
    } else {
        echo "Please enter your ID or Password";
        throw new Exception("Please enter your ID or Password");
    }
}

function chkPw($conn, $username, $password)
{
    $hashPw = validatePw($conn, $username);

    if (password_verify($password, $hashPw)) {

        $sql = "SELECT * 
        FROM user 
        WHERE username='" . $username . "'
        ";

        $res = mysqli_query($conn, $sql);
        $userInfo = mysqli_fetch_array($res);

        if ($userInfo) {
            setcookie('id', $userInfo['id'], time() + 60 * 30, '/admin');  // 30분
            echo true;
        } else {
            echo "something wrong";
            throw new Exception("something wrong");
        }
    } else {
        echo 'Wrong password';
        throw new Exception("Wrong password");
    }
}

function validatePw($conn, $username)
{
    $sql = "SELECT password FROM user
            WHERE username = '" . $username . "' 
            ";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($res);
    return $row->password;
}
