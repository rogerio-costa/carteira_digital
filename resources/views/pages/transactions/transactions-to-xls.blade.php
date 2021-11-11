<table class="table">
    <thead>
        <tr>

            <th>ID</th>
            <th>ID da Conta</th>
            <th>Nome da Transação</th>
            <th>Tipo da Transação </th>
            <th>Valor da transação</th>
            <th>Observação</th>
            <th>Data da Transação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->account_id }}</td>
            <td>{{ $transaction->transaction_name }}</td>
            @if ($transaction->type_of == 0)
            <td>Entrada</td>
            @else
            <td>Saída</td>
            @endif

            <td>{{ 'R$ '.number_format($transaction->value, 2, ',', '.') }}</td>
            <td>{{ $transaction->note }}</td>
            <td>{{ $transaction->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>