<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco</title>
</head>
<body>
    <?php
    if (isset($_GET['login']) && $_GET['login'] || isset($login) && $login) {
        if (isset($error)) {
            echo $error;
        }
    echo    "<h1>Login Ha ha</h1>";
    echo    "<form action='/?login=true' method='post'>
        <input type='text' name='nome' placeholder='Nome'>
        <input type='password' name='senha' placeholder='Senha'>
        <input type='submit' value='Envia'>
    </form>
    <a href='/'>Cadastre-se!</a>";
    } else {
        if (isset($error)) {
            echo $error;
        }
        echo    "<form action='/' method='post'>";
        echo    "<h1>Cadastro Ha ha</h1>";
        echo   "<input type='text' name='nome' placeholder='Nome'>
        <input type='password' name='senha' placeholder='Senha'>
        <input type='submit' value='Envia'>
    </form>
    <a href='/?login=true'>Faça login!!</a>";
    }?>
</body>
</html>