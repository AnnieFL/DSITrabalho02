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
        if (isset($extratos)) {
            echo "<h1>Extratos</h1>";
            echo "<table><tr>";
            echo "<td>Tipo</td>";
            echo "<td>Valor</td>";
            echo "<td>Data e Hora</td>";
            echo "</tr>";
            for ($i=0; $i<count($extratos); $i++) {
                echo "<tr>";
                echo "<td><a href='/extrato/".$extratos[$i]['id']."'>".$extratos[$i]['tipo']."</a></td>";
                echo "<td>".$extratos[$i]['valor']."</td>";
                echo "<td>".$extratos[$i]['data']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
    <a href="/">< Voltar</a>
</body>
</html>