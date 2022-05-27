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
        if (isset($extrato)) {
            echo "<h1>Extrato</h1>";
            echo "<table><tr>";
            echo "<td>Tipo</td>";
            echo "<td>Valor</td>";
            echo "<td>Descricao</td>";
            echo "<td></td>";
            echo "<td>Data e Hora</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>".$extrato['tipo']."</td>";
            echo "<td>".$extrato['valor']."</td>";
            echo "<td>".$extrato['descricao']."</td>";
            echo "<td>".$extrato['destino']."</td>";
            echo "<td>".$extrato['data']."</td>";
            echo "</tr>";
            echo "</table>";
        }
    ?>
    <a href="/extratos">< Voltar</a>
</body>
</html>