@extends('layouts.main')


@section('estilos')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

@endsection


@section('titulo', 'Tipos de Transações')


@section('conteudo')

<div class="container-fluid p-3">


    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header text-white bg-dark">
                Tipos de Transações
            </div>
            <div class="card-body">

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo da transação</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($transaction_types as $transaction_type)
                        <tr>
                            <td>{{ $transaction_type->name }}</td>
                            @if ($transaction_type->type_of == 0)
                                <td>Entrada</td>
                            @elseif ($transaction_type->type_of == 0)
                                <td>Saída</td>
                            @else
                                <td>Inválido</td>
                            @endif
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo da transação</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

    <div class="container mb-3 text-center">
        <a href="{{ route('transaction_types.create') }}" class="btn btn-primary col-md-3">Cadastar um Tipo de Transação</a>
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