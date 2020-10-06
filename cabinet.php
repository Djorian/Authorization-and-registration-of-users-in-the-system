<?php

if(!isset($_SESSION)) { session_start();}
    if(empty(@$_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }
    if ($_SESSION['user_id'] != $_GET['id']) {
        header('Location: cabinet.php?id='.$_SESSION['user_id']);
    }
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="HTML5 CSS3 Bootstrap 4 JavaScript PHP MySQL Font Awesome" />
    <meta name="author" content="Егоров Дмитрий" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png" type="image/png">
    <title>HTML5 CSS3 Bootstrap 4 JavaScript PHP MySQL Font Awesome</title>
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-5">
                        <h2 class="text-center mt-3 mb-3">Личный кабинет пользователя
                            <?php echo ucfirst($_SESSION['user_id']); ?></h2><a class="float-right" href="#"
                            id="cabinet-logout"><i class="fas fa-sign-out-alt"></i>
                            Выход</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="container">
        <div class="row">
            <div class="col-lg-12">
                    <?php
                        if (isset($_GET['id'])) {

                            $login = (string) trim(strip_tags(htmlspecialchars($_GET['id'])));

                            function __autoload($class) {
                                include "Classes/$class.php";
                            }

                            $mysql = new Database();

                            $result = $mysql->select('secondname, firstname, patronymic', 'users', '', "login='$login'", '', '');

                            foreach($result as $item) {
                                echo    "<h4 class='text-center mt-5'>Обновление данных</h4>
                                <form id='update-form'>
                                    <div class='form-group'>
                                        <label for='update-secondname'>Фамилия:</label>
                                        <input type='text' class='form-control' placeholder='Фамилия' value='".$item['secondname']."' id='update-secondname'
                                            name='update-secondname'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='update-firstname'>Имя:</label>
                                        <input type='text' class='form-control' placeholder='Имя' value='".$item['firstname']."' id='update-firstname'
                                            name='update-firstname'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='update-patronymic'>Отчество:</label>
                                        <input type='text' class='form-control' placeholder='Отчество' value='".$item['patronymic']."' id='update-patronymic'
                                            name='update-patronymic'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='update-password'>Пароль:</label>
                                        <input type='password' class='form-control' placeholder='Пароль' id='update-password'
                                            name='update-password'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='update-repeat-password'>Повторить пароль:</label>
                                        <input type='password' class='form-control' placeholder='Повторить пароль'
                                            id='update-repeat-password' name='update-repeat-password'>
                                    </div>
                                    <div id='update-message-block'></div>
                                    <div class='d-flex justify-content-center'>
                                        <button id='update-form-button' class='btn btn-outline-dark'>Обновить данные <i class='fas fa-sync-alt'></i></button>
                                    </div>
                                </form>";   
                            }
                        }
                    ?>
            </div>
        </div>
    </main>
    <footer id=" footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-copyright text-center mt-4 pb-3">&copy; 2020 Автор проекта: Егоров Дмитрий
                        <a href="https://www.djorian.com" target="_blank">djorian.com</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="./js/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="./js/cabinet.js"></script>
</body>

</html>