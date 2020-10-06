<?php 

if(!isset($_SESSION)) { session_start();} 

if(empty($_POST['update-secondname'])   ||
empty($_POST['update-firstname'])     ||
empty($_POST['update-patronymic'])     ||
empty($_POST['update-password'])   ||
empty($_POST['update-repeat-password']))
{
    $array[] = 'error-empty-fields';
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
    exit;
} else {

    function __autoload($class) {
        include "../Classes/$class.php";
    }

    $login = (string) trim(strip_tags(htmlspecialchars($_SESSION['user_id'])));

    $secondname = (string) trim(strip_tags(htmlspecialchars($_POST['update-secondname'])));

    $firstname = (string) trim(strip_tags(htmlspecialchars($_POST['update-firstname'])));

    $patronymic = (string) trim(strip_tags(htmlspecialchars($_POST['update-patronymic'])));

    $password = (string) trim(strip_tags(htmlspecialchars($_POST['update-password'])));

    $repeatpassword = (string) trim(strip_tags(htmlspecialchars($_POST['update-repeat-password'])));


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

    // Проверка пароля
    if(!preg_match("^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^", $password)){
        $array[] = 'error-password';
    }

    // Проверка на совпадение паролей
    if($password != $repeatpassword){
        $array[] = 'error-password-mismatch';
    }

    if(!empty((array)$array)){
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        exit;
    } else {

        $password = password_hash($password, PASSWORD_DEFAULT);

        $mysql = new Database();

        $result = $mysql->update('users', array('secondname'=>$secondname, 'firstname'=>$firstname, 'patronymic'=>$patronymic, 'password'=>$password), "login='$login'");

        if ($result) {
            $array[] = 'update-successful';
        } else {
            $array[] = 'error-server-data';
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}

?>