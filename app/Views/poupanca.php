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
    <div class='complexcenter center login'>
        <?php
        echo "<h1 class='center'>Conta Corrente R$".number_format($user['valor'], 2)."  Poupança R$".number_format($poupanca['valor'], 2)."</h1>";
        ?>
    <form action="/depositar" method='post'>
        <input type="number" min=0 max=<?php echo $poupanca['valor']; ?> step="0.01" name='valor' value='0'>
        <input type="hidden" name='sacar' value=1>
        <input type="submit" value='sacar'>
    </form><br>
    <form action="/depositar" method='post'>
        <input type="number" min=0 max=<?php echo $user['valor']; ?> step="0.01" name='valor' value='0'>
        <input type="hidden" name='sacar' value=0>
        <input type="submit" value='depositar'>
    </form>
    </div>
    <a class='nonlink fixedBotLef' href="/">< Voltar</a>
</body>
</html>