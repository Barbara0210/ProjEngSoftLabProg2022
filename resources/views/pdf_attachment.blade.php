Aqui está a tua fatura {{ $name }}

<!DOCTYPE html>
<html>

<head>
    <title>Fatura de Pagamento</title>
</head>

<body>
    <h1>Fatura de Pagamento</h1>
    <table>
        <tr>
            <td>Nome do Cliente: {{ $name }}</td>
        </tr>
        <tr>
            <td>Número da Fatura: {{ $randomNumber = mt_rand(10000, 19999); }}</td>
        </tr>
        <tr>
        <?php
            use Carbon\Carbon;
            $currentDateTime = Carbon::now();
            $currentDateTime = date('d-m-Y H:i:s');
        ?>
            <td>Data de Emissão: {{ $currentDateTime }}</td>
        </tr>
    </table><br>
    <h2>Detalhes do Pagamento:</h2>
    <table>
        <tr>
            <th>Serviço: Subscrição Marketplace Premium</th>
            <th>Duração: 1 ano</th>
            <th>Preço: 10€</th>
        </tr>
        <tr>
            <td colspan="3">Total:</td>
            <td>10€</td>
        </tr>
    </table>
    <p>Obrigado pelo seu pagamento!</p>
</body>

</html>
