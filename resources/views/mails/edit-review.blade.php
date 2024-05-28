<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <h3>Отредактирован отзыв на сайте</h3>
        <br>
        <p>Номер отзыва: {{ $review->id }}</p>
        <p>Отзыв от: {{ $review->user->name }}</p>
        <p>Текст отзыва: {{ $review->text }}</p>
    </body>
</html>
