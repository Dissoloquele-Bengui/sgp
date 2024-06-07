<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório dos Pedidos</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background-color: #f4f4f4;
        }
        img {
            width: 50px;
            height: 50px;
            display: block;
            margin: 0 auto;
        }
        .content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content h2, .content h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .content h2 {
            color: #333;
        }
        .content h3 {
            color: #555;
        }
        .table {
            margin-top: 20px;
            overflow-x: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: solid 1px #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #4d4747;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .total-row {
            font-weight: bold;
            background: #e2e2e2;
        }
    </style>
</head>
<body>

    <section class="content">
        <h2>Relatório dos Pedidos</h2>
        <h3>Período de {{$data['inicio']}} à {{$data['termino']}}</h3>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Usuário</th>
                        <th>Tipo de Pedido</th>
                        <th>Estado</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['pedidos'] as $pedido)
                        <tr>
                            <td>{{ $pedido->descricao }}</td>
                            <td>{{ $pedido->user }}</td>
                            <td>{{ $pedido->tipo }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>{{ $pedido->created_at }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Total</td>
                        <td colspan="4">{{$data['pedidos']->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
