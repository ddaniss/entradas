<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/nuevaEntrada.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Merriweather:300italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>
        <a href="/" class="logo">Entradas_</a>
    </header>
    <div class="formContainer">
        <form method="POST" class="loginForm" action="./validaUser.php">
            <label>
                USER <br>
                <input name="user" type="text">
            </label>
            <label>
                PASSWORD <br>
                <input name="pass" type="password">
            </label> <br>
            <button>ENVIAR</button>
        </form>
    </div>
    <footer>
        Copyright 2020 Entradas
    </footer>
</body>

</html>