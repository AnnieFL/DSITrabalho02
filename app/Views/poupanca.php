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
        echo "<h1>".$user['nome']." <br> Conta Corrente R$".number_format($user['valor'], 2)." <br> Poupança R$".number_format($poupanca['valor'], 2)."</h1>";
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
    <a href="/">< Voltar</a>
</body>
</html>