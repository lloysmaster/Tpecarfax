<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel="stylesheet" href="assets/css/estiloGeneral.css">
</head>
<body>
    <nav>
        <ul class='nav'>
            <li><a href= "?action=vehiculos">logo</a></li>
            <li><a>categorias</a></li>
            <li><a href= "?action=login">login</a></li>
        </ul>
    </nav>

    <h1>Login</h1>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="?action=login" method="POST">
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Contraseña: <input type="password" name="password" required></label><br>
        <button type="submit">Ingresar</button>
    </form>
    <a href="?action=register">dont have acount?</a>
</body>
</html>