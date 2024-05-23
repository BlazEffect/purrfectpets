<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <h3>Зарегистрировался новый пользователь на сайте</h3>
        <br>
        <p>ID пользователя: <b>{{ $user->id }}</b></p>
        <p>Логин пользователя: <b>{{ $user->email }}</b></p>
        <br>
        <p>Данные профиля пользователя:</p>
        <p>ФИО: {{ $userProfile['first_name'] }} {{ $userProfile['surname'] }} {{ $userProfile['last_name'] }}</p>
        <p>Почта: {{ $user->email }}</p>
        <p>Номер телефона: {{ $userProfile['phone'] }}</p>
    </body>
</html>
