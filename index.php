<?php

if(!isset($_SESSION)) { session_start();}

if(!empty(@$_SESSION['user_id'])) {
    header('Location: cabinet.php?id='.$_SESSION['user_id']);
}

?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="HTML5 CSS3 Bootstrap4 JavaScript PHP MySQL Font Awesome" />
    <meta name="author" content="Егоров Дмитрий" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <title>HTML5 CSS3 Bootstrap4 JavaScript PHP MySQL Font Awesome</title>
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-5 mb-5">
                        <h2>HTML5 CSS3 Bootstrap4 JavaScript PHP MySQL Font Awesome</h2>
                        <p>Авторизация и регистрация пользователей в системе</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="text-center mt-3">Войти в систему</h2>
                <form id="sign-in-form">
                    <div class="form-group">
                        <label for="sign-in-login">Логин или почта:</label>
                        <input type="text" class="form-control" placeholder="Логин или почта" id="sign-in-login"
                            name="sign-in-login">
                    </div>
                    <div class="form-group">
                        <label for="sign-in-password">Пароль:</label>
                        <input type="password" class="form-control" placeholder="Пароль" id="sign-in-password"
                            name="sign-in-password">
                    </div>
                    <div id="sign-in-message-block"></div>
                    <button id="sign-in-form-button" class="btn btn-outline-dark">Войти <i class="fas fa-sign-in-alt"></i></button>
                    <a class="float-right" href="#" data-toggle="modal"
                        data-target="#modal-restore-password">Восстановить пароль?</a>
                </form>
            </div>
            <div class="col-lg-6">
                <h2 class="text-center mt-3">Регистрация</h2>
                <form id="sign-up-form">
                    <div class="form-group">
                        <label for="sign-up-login">Логин:</label>
                        <input type="text" class="form-control" placeholder="Логин" id="sign-up-login"
                            name="sign-up-login">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-secondname">Фамилия:</label>
                        <input type="text" class="form-control" placeholder="Фамилия" id="sign-up-secondname"
                            name="sign-up-secondname">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-firstname">Имя:</label>
                        <input type="text" class="form-control" placeholder="Имя" id="sign-up-firstname"
                            name="sign-up-firstname">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-patronymic">Отчество:</label>
                        <input type="text" class="form-control" placeholder="Отчество" id="sign-up-patronymic"
                            name="sign-up-patronymic">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-email">Почта:</label>
                        <input type="email" class="form-control" placeholder="Почта" id="sign-up-email"
                            name="sign-up-email">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-password">Пароль:</label>
                        <input type="password" class="form-control" placeholder="Пароль" id="sign-up-password"
                            name="sign-up-password">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-repeat-password">Повторить пароль:</label>
                        <input type="password" class="form-control" placeholder="Повторить пароль"
                            id="sign-up-repeat-password" name="sign-up-repeat-password">
                    </div>
                    <div id="sign-up-message-block"></div>
                    <div class="d-flex justify-content-center">
                        <button id="sign-up-form-button" class="btn btn-outline-dark">Зарегистрироваться <i class="fas fa-user-plus"></i></button>
                    </div>
                </form>
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
    <!-- Modal Восстановление пароля -->
    <div class="modal fade" id="modal-restore-password" tabindex="-1" role="dialog"
        aria-labelledby="modal-restore-password-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-restore-password-label">Восстановить пароль?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Для восстановления пароля напишите на почту администратору сайта<a href="mailto:admin@yourwebsite.loc?subject=Восстановление пароля&body=Пожалуйста, укажите свой логин, почту и новый пароль.
&cc=admin@yourwebsite.loc
&bcc=admin@yourwebsite.loc"> admin@yourwebsite.loc</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="./js/index.js"></script>
</body>

</html>