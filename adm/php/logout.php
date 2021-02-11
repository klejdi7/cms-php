<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie('email', $_POST['email'], 1);
    setcookie('password', password_hash($_POST['pass'], PASSWORD_BCRYPT), 1);
    header("location: /");
?>
