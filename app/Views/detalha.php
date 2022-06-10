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
        if (isset($extrato)) {
            echo "<br><br><br><h1 class='center'>Extrato</h1>";
            echo "<div class='complexcenter contain'>";
            echo "<table>";
            echo "<tr><td>Tipo</td><td class='center' colspan=2>---------------------</td><td style='text-align:right;'>".$extrato['tipo']."</td></tr>";
            echo "<tr><td>Valor</td><td class='center' colspan=2>---------------------</td><td style='text-align:right;'>".number_format($extrato['valor'], 2)."</td></tr>";
            echo "<tr><td>Descricao</td><td class='center' colspan=2>---------------------</td><td style='text-align:right;'>".$extrato['descricao']."</td></tr>";
            echo "<tr><td>Destinatario/Remetente</td><td class='center' colspan=2>---------------------</td><td style='text-align:right;'>".$extrato['destino']."</td></tr>";
            echo "<tr><td>Data e Hora</td><td class='center' colspan=2>---------------------</td><td style='text-align:right;'>".$extrato['data']."</td></tr>";
            echo "</table></div>";
        }
    ?>
    <a class='nonlink fixedBotLef' href="/extratos">< Voltar</a>
</body>
</html>