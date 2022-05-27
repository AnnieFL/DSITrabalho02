<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco</title>
</head>
<body>
    <h1>Pagar</h1>
    <?php
        echo "<h2>".$user['nome']." - ".$user['valor']."</h2>"
    ?>
    <form action="/pagar" method='post'>
        <label for="tipo">Tipo</label><br>
        <select name="tipo">
            <option value="Pix">Pix</option>
            <option value="Debito">Débito</option>
            <option value="Debito">Crédito</option>
            <option value="Boleto">Boleto</option>
        </select><br>
        <input type="text" name='destino' placeholder='Destino' required><br>
        <input type="number" name='valor' placeholder='R$0,00' min='0' <?php echo "max =".$user['valor']?>' required><br>
        <textarea name="descricao" cols="25" rows="5" placeholder='Descrição' style="resize: none;" required></textarea><br>
        <input type="hidden" name='usuario' <?php echo "value='".$user['numero']."'" ?>>
        <input type="submit">
    </form>
</body>
</html>