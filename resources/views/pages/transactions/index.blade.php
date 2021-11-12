@extends('layouts.main')


@section('estilos')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

@endsection


@section('titulo', 'Minhas Transações')


@section('conteudo')

<div class="container-fluid p-3">

    <div class="container-fluid mb-3">

        <div class="card-deck">

            <div class="card">
                <div class="card-header text-white bg-success">
                    Saldo disponível
                </div>
                <div class="card-body">
                    <h5 class="card-title"> {{ 'R$ '.number_format($account->balance, 2, ',', '.') }} </h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-white bg-primary">
                    Quantidade de entradas realizadas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $qtd_inbound_transactions }}</h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-white bg-danger">
                    Quantidade de saídas realizadas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $qtd_outbound_transactions }}</h5>
                </div>
            </div>


        </div>

    </div>

    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header text-white bg-dark">
                Minhas Transações
            </div>
            <div class="card-body">

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Transação</th>
                            <th>Valor</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($transactions as $transaction)
                        @if ($transaction->type_of == 1)
                        <tr style="color:#DD3545">
                            <td>{{ date( 'd/m/Y - H:i:s' , strtotime($transaction->created_at))}}</td>
                            <td>{{ $transaction->transaction_name }}</td>
                            <td>{{ 'R$ '.number_format($transaction->value, 2, ',', '.') }}</td>
                            <td>{{ $transaction->note }}</td>

                        </tr>
                        @else
                        <tr style="color:#28A745">
                            <td>{{ date( 'd/m/Y - H:i:s' , strtotime($transaction->created_at))}}</td>
                            <td>{{ $transaction->transaction_name }}</td>
                            <td>{{ 'R$ '.number_format($transaction->value, 2, ',', '.') }}</td>
                            <td>{{ $transaction->note }}</td>

                        </tr>

                        @endif
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Data</th>
                            <th>Transação</th>
                            <th>Valor</th>
                            <th>Observação</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="container mb-3 text-center">
                    <button class="btn btn-danger col-md-2">Gerar PDF</button>

                    {{--<a href="{{ route('transactions.xls-export') }}" class="btn btn-success col-md-2">Gerar XLS
                        Geral</a>
                    --}}

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success col-md-2" data-toggle="modal" data-target="#xlsModal">
                        Gerar XLS
                    </button>

                    <a href="{{ route('transactions.create') }}" class="btn btn-primary col-md-2">Fazer uma
                        Transação</a>

                </div>

            </div>
        </div>
    </div>

</div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="xlsModal" tabindex="-1" role="dialog" aria-labelledby="xlsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-dark">
                <h5 class="modal-title" id="xlsModalLabel">Gerar XML com Filtros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form name="formXls">

                    @csrf

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="transaction_type_id">Transação</label>
                            <select id="transaction_type_id" name="transaction_type_id" class="form-control">
                                <option value="" selected>Selecione uma opção</option>
                                @foreach ($transaction_types as $transaction_type)
                                <option value={{ $transaction_type->id }}> {{ $transaction_type->name }} -
                                    @if ( $transaction_type->type_of == 0 )
                                    Entrada
                                    @else
                                    Saída
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Valor da transação</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input type="number" step="0.01" class="form-control" id="value" name="value"
                                    placeholder="Exemplo: 100,00">
                            </div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="initialDate">Data inicial</label>
                            <input type="date" class="form-control" id="initialDate" name="initialDate">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="finalDate">Data final</label>
                            <input type="date" class="form-control" id="finalDate" name="finalDate">
                        </div>

                    </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Gerar XLS</button>
            </div>

            </form>
        </div>
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

<script>
    $(function(){
        $('form[name="formXls"]').submit(function(event){
            event.preventDefault();

            $.ajax({
                url: "{{ route('transactions.xls-export') }}",
                type: "get",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response){
                    if(response.success === true){
                        //window.open({{ route('transactions.xls-export') }})
                    }
                }
            });
        });
    });
</script>

@endsection