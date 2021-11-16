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
            <td>{{ $transaction->transactionType->name }}</td>
            @if ($transaction->transactionType->type_of == 0)
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
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>TOTAL DO PERÍODO </th>
            <th>{{ 'R$ '.number_format($periodTotal, 2, ',', '.') }}</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>