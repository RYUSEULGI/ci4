<?php

if (isset($_COOKIE['id'])) {
    unset($_COOKIE['id']);
    setcookie("id", "", time() + 60 * 30, '/admin');
    echo '<script> location.href="/admin/index.php" </script>';
}
