<?php

if(!isset($_SESSION)) { session_start();} 

if(empty($_POST['sign-in-login'])   ||
empty($_POST['sign-in-password']))
{
    $array[] = 'error-empty-fields';
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
    exit;
} else {

    function __autoload($class) {
        include "../Classes/$class.php";
    }

    $login = (string) trim(strip_tags(htmlspecialchars($_POST['sign-in-login'])));

    $password = (string) trim(strip_tags(htmlspecialchars($_POST['sign-in-password'])));

    $mysql = new Database();

    $result = $mysql->select('login, email, password', 'users', '', "login='$login' OR email='$login'", '', '');

    if ($result) {

        foreach($result as $row) {
            $row['password'];
        }

        // password_verify — Проверяет, соответствует ли пароль хешу
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['login'];  
            $array[] = 'sign-in-successful';
        } else {
            $array[] = 'error-login-or-password-do-not-match';     
        } 
    } else {
        $array[] = 'error-login-or-password-do-not-match';   
    }
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
}

?>