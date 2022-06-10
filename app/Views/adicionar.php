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

        <h1>Depositar</h1>
        <?php
        echo "<h2>Saldo Atual - R$".number_format($user['valor'], 2)."</h2>"
        ?>
    <form action="/adicionar" method='post'>
        <label for="tipo">Tipo</label><br>
        <select name="tipo">
            <option value="Pix">Pix</option>
            <option value="Debito">Débito</option>
            <option value="Debito">Crédito</option>
            <option value="Boleto">Boleto</option>
        </select><br>
        <input type="number" name='valor' placeholder='R$0,00' min='0' step='0.01' required><br>
        <textarea name="descricao" cols="25" rows="5" placeholder='Descrição' style="resize: none;" required></textarea><br>
        <input type="hidden" name='usuario' <?php echo "value='".$user['numero']."'" ?>>
        <input class='button3' type="submit">
    </form>
    </div>
    <a class='nonlink fixedBotLef' href="/">< Voltar</a>

</body>
</html>