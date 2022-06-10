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
        if (isset($extratos) && $extratos != null) {
            echo "<br><br><br><h1 class='center'>Extratos</h1>";
            echo "<table class='complexcenter normal'><tr class='normal'>";
            echo "<td class='normal'>Tipo</td>";
            echo "<td class='normal'>Valor</td>";
            echo "<td class='normal'>Data e Hora</td>";
            echo "</tr>";
            for ($i=0; $i<count($extratos); $i++) {
                echo "<tr class='normal'>";
                echo "<td class='normal'><a href='/extrato/".$extratos[$i]['id']."'>".$extratos[$i]['tipo']."</a></td>";
                echo "<td class='normal'>".number_format($extratos[$i]['valor'], 2)."</td>";
                echo "<td class='normal'>".$extratos[$i]['data']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<br><br><br><br><br><br><div class='complexcenter center' style='font-size: 2em; color: #565656'>NADA AQUI</div>";
        }
        ?>
    <a class='fixedBotLef nonlink' href="/">< Voltar</a>
</body>
</html>