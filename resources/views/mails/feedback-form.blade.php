<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <h3>Новое обращение</h3>
        <p>ФИО: {{ $data['fio'] }}</p>
        <p>Почта: {{ $data['email'] }}</p>
        <p>Обращение: {{ $data['message'] }}</p>
    </body>
</html>
