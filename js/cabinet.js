const cabinetLogout = document.querySelector('#cabinet-logout');
const updateForm = document.querySelector('#update-form');

// Выход пользователя из системы
cabinetLogout.addEventListener('click', () => {
    const ajax = async () => {
        const response = await fetch('php/logout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'logout',
        });

        if (!response.ok) {
            throw new Error(response.status);
        } else {
            const data = await response.text();
            if (data == 'logout') {
                setTimeout(() => {
                    location.replace("index.php");
                }, 1000);
            } else {
                alert('Ошибка, попробуйте позже!');
            }
        }
    };
    ajax()
        .catch(error => (alert(error)));
});

// Обновления данных пользователя в системе
updateForm.addEventListener('submit', (event) => {

    event.preventDefault();

    let updateUpPassword = document.querySelector('#update-password');
    let updateUpRepeatPassword = document.querySelector('#update-repeat-password');

    let updateMessageBlock = document.querySelector('#update-message-block');
    updateMessageBlock.innerHTML = '';

    let out = '';

    const ajax = async () => {
        const response = await fetch('php/update_password.php', {
            method: 'POST',
            body: new FormData(updateForm),
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

                    case 'error-secondname':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите правильную фамилию пользователя от 2 до 50 букв!</p>');
                        break;
                    case 'error-firstname':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите правильное имя пользователя от 2 до 50 букв!</p>');
                        break;
                    case 'error-patronymic':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, введите правильное отчество пользователя от 2 до 50 букв!</p>');
                        break;
                    case 'error-password':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пожалуйста, создайте пароль, содержащий не менее 8 символов, который будет содержать как минимум одну строчную и заглавную букву, а так же одно число!</p>');
                        break;
                    case 'error-password-mismatch':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Пароли не совпадают!</p>');
                        break;
                    case 'error-server-data':
                        responseDataArray.push('<p class="failed-message-sending"><strong>*Ошибка сервера!</p>');
                        break;
                    case 'update-successful':
                        responseDataArray.push('<p class="successful-message-sending"><strong>Данные успешно обновлены!</p>');
                        updateUpPassword.value = '';
                        updateUpRepeatPassword.value = ''
                        break;
                }
            }

            for (let i = 0; i < responseDataArray.length; i++) {
                out += responseDataArray[i];
            }

            updateMessageBlock.innerHTML = out;
        }
    };
    ajax()
        .catch(error => (updateMessageBlock.innerHTML = `<p class="failed-message-sending"><strong>${error}</strong></p>`));
    setTimeout(() => {
        updateMessageBlock.innerHTML = '';
    }, 3000)
});