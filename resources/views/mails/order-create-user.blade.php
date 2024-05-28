<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <h3>Заказ успешно создан</h3>
        <br>
        <p>Номер заказа: {{ $order->id }}</p>
        <p>ФИО: {{ $orderProperties->FIO }}</p>
        <p>Почта: {{ $orderProperties->email }}</p>
        <p>Телефон: {{ $orderProperties->phone }}</p>
        <p>Адрес: {{ $orderProperties->address }}</p>
        <br>
        <p>Товары:</p>
        @foreach($order->products as $product)
            <p>{{ $product->name }}</p>
        @endforeach
        <br>
        <p>Спасибо за заказ</p>
    </body>
</html>
