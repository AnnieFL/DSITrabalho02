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
    <title>Tejas Bank</title></head>
<body>
<h1 style="font-family: 'Alegreya Sans SC', sans-serif;" class='fixedTopRig'><a class='nonlink' href='/'>Tejas Bank</a></h1>
    <br><br><br>
    <h1 class='center'>Bem Vindo 
    <?php
        echo $user['nome'];
    ?>
    </h1>
    <br>
    <div class='complexcenter center contain'>
        <?php
            if (session()->getFlashdata('error')) {
                    echo "<div class='erro'>".session()->getFlashdata('error')."</div>";
            }
        ?>
        <table class='complexcenter center menu'>
            <tr class='menu'>
                <td class='menu hover' colspan=2>
                    <a class='nonlink' href="/adicionar">Depositar</a>
                </td>
            </tr>
            <tr class='menu'>
                <td class='hover menu'>
                    <a class='nonlink' href="/extratos">Extratos</a>
                </td>
                <td class='hover menu'>
                    <a class='nonlink' href="/poupanca">Poupanca</a>
                </td>
            </tr>
            <tr class='menu'>
            <td class='hover menu'>
                    <a class='nonlink' href="/pagar">Pagar</a>
                </td>
                <td class='hover menu'>
                    <a class='nonlink' href="/transferir">Transferir</a>
                </td>
            </tr>
        </table>
        <br>
        <hr>
        <h2>Saldo: R$<?php echo number_format($user['valor'], 2); ?> </h2> 
    </div>
    <a class='fixedTopLef button4' href="/logout">Logout</a>
</body>
</html>