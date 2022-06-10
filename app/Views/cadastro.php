<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@1,900&family=Monofett&display=swap" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>"/>
    <title>Tejas Bank</title>
</head>
<body>
    <h1 style="font-family: 'Alegreya Sans SC', sans-serif;" class='fixedTopRig'><a class='nonlink' href='/'>Tejas Bank</a></h1>
    <?php
    if (isset($_GET['login']) && $_GET['login'] || isset($login) && $login) {
        echo "<div class='complexcenter center login'>";
        if (session()->getFlashdata('error')) {
            echo "<div class='erro'>".session()->getFlashdata('error')."</div>";
        }
    echo    "<h1>Login</h1>";
    echo    "<form action='/?login=true' method='post'>
        <input type='text' name='nome' placeholder='Nome'><br>
        <input type='password' name='senha' placeholder='Senha'><br>
        <input class='button' type='submit' value='Login'>
    </form><br>
    <a href='/'>Cadastre-se!</a></div>";
    } else {
        echo "<div class='complexcenter center login'>";
        if (session()->getFlashdata('error')) {
                echo "<div class='erro'>".session()->getFlashdata('error')."</div>";
            }
        echo    "<h1>Cadastro</h1>";
        echo    "<form action='/' method='post'>";
        echo   "<input type='text' name='nome' placeholder='Nome'><br>
        <input type='password' name='senha' placeholder='Senha'><br>
        <input type='submit' class='button' value='Cadastrar'>
    </form><br>
    <a href='/?login=true'>Faça login!</a></div>";
    }?>
</body>
</html>