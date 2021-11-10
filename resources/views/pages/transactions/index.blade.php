@extends('layouts.main')


@section('estilos')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

@endsection


@section('titulo', 'Minhas Transações')


@section('conteudo')

<div class="container-fluid p-3">


    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header text-white bg-dark">
                Minhas Transações
            </div>
            <div class="card-body">

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Transação</th>
                            <th>Tipo da transação</th>
                            <th>Valor</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction }}</td>
                            <td>{{ $transaction }}</td>
                            <td>{{ $transaction->value }}</td>
                            <td>{{ $transaction->note }}</td>
                           
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Transação</th>
                            <th>Tipo da transação</th>
                            <th>Valor</th>
                            <th>Observação</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

    <div class="container mb-3 text-center">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary col-md-3">Cadastar uma Transação</a>
    </div>

</div>


@endsection


@section('scripts')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function() {
    
        $('#example').dataTable( {
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
            }
        } );
    } );
</script>

@endsection