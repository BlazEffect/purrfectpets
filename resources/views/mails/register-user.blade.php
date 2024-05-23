<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <h3>Вы зарегистрировались на сайте PurrfectPets</h3>
        <br>
        <p>Ваш логин: <b>{{ $user->email }}</b></p>
        <p>Ваш пароль: <b>{{ $password }}</b></p>
        <br>
        <p>Ваши данные профиля:</p>
        <p>ФИО: {{ $userProfile['first_name'] }} {{ $userProfile['surname'] }} {{ $userProfile['last_name'] }}</p>
        <p>Почта: {{ $user->email }}</p>
        <p>Номер телефона: {{ $userProfile['phone'] }}</p>
    </body>
</html>
