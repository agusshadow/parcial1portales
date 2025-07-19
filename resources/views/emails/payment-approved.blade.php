<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago aprobado</title>
</head>
<body>
    <h1>¡Pago aprobado!</h1>
    <p>Hola {{ $order->user->name }},</p>
    <p>Gracias por tu compra. Tu código de activación es:</p>
    <h2 style="color: green;">{{ $codigo }}</h2>
    <p>¡Disfruta tu juego!</p>
</body>
</html>