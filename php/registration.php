<?php

if(!isset($_SESSION)) { session_start();} 

if(
    empty($_POST['sign-up-login'])   ||
    empty($_POST['sign-up-secondname'])   ||
    empty($_POST['sign-up-firstname'])   ||
    empty($_POST['sign-up-patronymic'])   ||
    empty($_POST['sign-up-email'])     ||
    empty($_POST['sign-up-password'])   ||
    empty($_POST['sign-up-repeat-password']) ||
    !filter_var($_POST['sign-up-email'],FILTER_VALIDATE_EMAIL)) {
        $array[] = 'error-empty-fields';
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        exit;
} else {

    function __autoload($class) {
        include "../Classes/$class.php";
    }

    $login = (string) trim(strip_tags(htmlspecialchars($_POST['sign-up-login'])));

    $secondname = (string) trim(strip_tags(htmlspecialchars($_POST['sign-up-secondname'])));

    $firstname = (string) trim(strip_tags(htmlspecialchars($_POST['sign-up-firstname'])));

    $patronymic = (string) trim(strip_tags(htmlspecialchars($_POST['sign-up-patronymic'])));

    $email = (string) trim(strip_tags(htmlspecialchars($_POST['sign-up-email'])));

    $password = (string) trim(strip_tags(htmlspecialchars($_POST['sign-up-password'])));

    $repeatpassword = (string) trim(strip_tags(htmlspecialchars($_POST['sign-up-repeat-password'])));

    // Проверка логина
    if(!preg_match("^[A-Za-z][A-Za-z0-9]{2,30}$^", $login)){
        $array[] = 'error-login';
    }

    // Проверка фамилии
    if(!preg_match('/^[\p{Cyrillic}\p{Common}]{2,50}+$/u', $secondname)){
        $array[] = 'error-secondname';
    }

    // Проверка имени
    if(!preg_match('/^[\p{Cyrillic}\p{Common}]{2,50}+$/u', $firstname)){
        $array[] = 'error-firstname';
    }

    // Проверка отчества
    if(!preg_match('/^[\p{Cyrillic}\p{Common}]{2,50}+$/u', $patronymic)){
        $array[] = 'error-patronymic';
    }

    // Проверка почты
    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)){
        $array[] = 'error-email';
    }

    // Проверка пароля
    if(!preg_match("^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^", $password)){
        $array[] = 'error-password';
    }

    // Проверка на совпадение паролей
    if($password != $repeatpassword){
        $array[] = 'error-password-mismatch';
    }

    $mysql = new Database();

    $result = $mysql->select('login, email', 'users', '', "login='$login' OR email='$email'", '', '');

    // Если имя пользователя или адрес электронной почты уже заняты
    if ($result) {
        $array[] = 'error-login-or-mail-is-busy';
    }

    if(!empty((array)$array)){
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $result = $mysql->insert('users', array('login'=>$login, 'secondname'=>$secondname, 'firstname'=>$firstname, 'patronymic'=>$patronymic, 'email'=>$email, 'password'=>$password));

        if ($result) {
            $array[] = 'sign-up-successful';
        } else {
            $array[] = 'error-server-data';
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }   
}

?>