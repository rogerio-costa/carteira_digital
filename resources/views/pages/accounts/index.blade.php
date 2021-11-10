@extends('layouts.main')


@section('estilos')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

@endsection


@section('titulo', 'Dashboard')


@section('conteudo')

<div class="container-fluid p-3">

    <div class="container-fluid mb-3">

        <div class="card-deck">

            <div class="card">
                <div class="card-header text-white bg-success">
                    Saldo disponível
                </div>
                <div class="card-body">
                    <h5 class="card-title"> {{-- 'R$ '.number_format($conta->saldo, 2, ',', '.') --}} </h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-white bg-primary">
                    Quantidade de entradas realizadas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{-- $qtd_depositos --}}</h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-white bg-danger">
                    Quantidade de saídas realizadas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{-- $qtd_saques --}}</h5>
                </div>
            </div>


        </div>

    </div>


    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header text-white bg-dark">
                Histórico de Transações
            </div>
            <div class="card-body">

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo da transação</th>
                            <th>Valor (R$)</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- 
                        @foreach ($depositos as $deposito)
                        <tr>
                            <td>{{ date( 'd/m/Y - H:i:s' , strtotime($deposito->created_at))}}</td>
                            <td>Depósito</td>
                            <td>{{ 'R$ '.number_format($deposito->valor_deposito, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach

                        @foreach ($saques as $saque)
                        <tr>
                            <td>{{ date( 'd/m/Y - H:i:s' , strtotime($saque->created_at))}}</td>
                            <td>Saque</td>
                            <td>{{ 'R$ '.number_format($saque->valor_saque, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        --}}

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Data</th>
                            <th>Tipo da transação</th>
                            <th>Valor (R$)</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

    <div class="container mb-3 text-center">
        <button class="btn btn-danger col-md-2">Gerar PDF</button>
        <button class="btn btn-success col-md-2">Gerar XLS</button>
        <a href="{{-- route('deposito.create') --}}" class="btn btn-primary col-md-2">Realizar Transação</a>
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