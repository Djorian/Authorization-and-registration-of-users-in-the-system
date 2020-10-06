const signUpForm = document.querySelector('#sign-up-form');
const signInForm = document.querySelector('#sign-in-form');

// Регистрация пользователя в системе
signUpForm.addEventListener('submit', (event) => {

    event.preventDefault();

    let signUpLogin = document.querySelector('#sign-up-login');
    let signUpSecondname = document.querySelector('#sign-up-secondname');
    let signUpFirstname = document.querySelector('#sign-up-firstname');
    let signUpPatronymic = document.querySelector('#sign-up-patronymic');
    let signUpEmail = document.querySelector('#sign-up-email');
    let signUpPassword = document.querySelector('#sign-up-password');
    let signUpRepeatPassword = document.querySelector('#sign-up-repeat-password');

    let signUpMessageBlock = document.querySelector('#sign-up-message-block');
    signUpMessageBlock.innerHTML = '';

    let out = '';

    const ajax = async () => {
        const response = await fetch('php/registration.php', {
            method: 'POST',
            body: new FormData(signUpForm),
        });

        if (!response.ok) {
            throw new Error(response.status);
        } else {
            const data = await response.json();

            const responseDataArray = [];

            for (const key in data) {
                switch (data[key]) {
                    case 'error-empty-fields':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Заполните необходимые поля!</strong></p>');
                        break;
                    case 'error-login':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите правильный логин пользователя от 2 до 30 букв!</p>');
                        break;
                    case 'error-secondname':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите правильную фамилию пользователя от 2 до 50 букв!</p>');
                        break;
                    case 'error-firstname':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите правильное имя пользователя от 2 до 50 букв!</p>');
                        break;
                    case 'error-patronymic':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите правильное отчество пользователя от 2 до 50 букв!</p>');
                        break;
                    case 'error-email':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите корректный адрес электронной почты!</p>');
                        break;
                    case 'error-password':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, создайте пароль, содержащий не менее 8 символов, который будет содержать как минимум одну строчную и заглавную букву, а так же одно число!</p>');
                        break;
                    case 'error-password-mismatch':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пароли не совпадают!</p>');
                        break;
                    case 'error-login-or-mail-is-busy':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Логин или почта уже используются</p>');
                        break;
                    case 'error-server-data':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Ошибка сервера!</p>');
                        break;
                    case 'sign-up-successful':
                        responseDataArray.push('<p class="successful-message-sending"><strong>Пользователь успешно создан!</p>');
                        signUpLogin.value = '';
                        signUpSecondname.value = '';
                        signUpFirstname.value = '';
                        signUpPatronymic.value = '';
                        signUpEmail.value = '';
                        signUpPassword.value = '';
                        signUpRepeatPassword.value = ''
                        break;
                }
            }

            for (let i = 0; i < responseDataArray.length; i++) {
                out += responseDataArray[i];
            }

            signUpMessageBlock.innerHTML = out;
        }
    };
    ajax()
        .catch(error => (signUpMessageBlock.innerHTML = `<p class="failed-message-sending"><strong>${error}</strong></p>`));
    setTimeout(() => {
        signUpMessageBlock.innerHTML = '';
    }, 3000)
});

// Авторизация пользователя в системе
signInForm.addEventListener('submit', (event) => {

    event.preventDefault();

    let signInMessageBlock = document.querySelector('#sign-in-message-block');

    let out = '';

    const ajax = async () => {
        const response = await fetch('php/login.php', {
            method: 'POST',
            body: new FormData(signInForm),
        });

        if (!response.ok) {
            throw new Error(response.status);
        } else {
            const data = await response.json();

            const responseDataArray = [];

            for (const key in data) {
                switch (data[key]) {
                    case 'error-empty-fields':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Заполните необходимые поля!</strong></p>');
                        break;
                    case 'error-login-or-password-do-not-match':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Неверный логин или пароль!</strong></p>');
                        break;
                    case 'sign-in-successful':
                        responseDataArray.push('<p class="successful-message-sending"><strong>Добро пожаловать!</strong></p>');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                        break;
                }
            }

            for (let i = 0; i < responseDataArray.length; i++) {
                out += responseDataArray[i];
            }

            signInMessageBlock.innerHTML = out;
        }
    };
    ajax()
        .catch(error => (signInMessageBlock.innerHTML = `<p class="failed-message-sending"><strong>${error}</strong></p>`));
    setTimeout(() => {
        signInMessageBlock.innerHTML = '';
    }, 3000)
});