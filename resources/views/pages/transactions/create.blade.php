@extends('layouts.main')


@section('estilos')

@endsection


@section('titulo', 'Cadastro de Transação')


@section('conteudo')

<div class="container p-3">

    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header text-white bg-dark">
                Cadastro de Transação
            </div>
            <div class="card-body">

                <form action="{{ route('transactions.store') }}" method="POST">

                    @csrf

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="transaction_type_id">Transação</label>
                            <select id="transaction_type_id" name="transaction_type_id" class="form-control">
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
                        <div class="form-group col-md-12">
                            <label for="note">Notas / Observações</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </div>
                    </div>


                    <div class="container mb-3 text-center">
                        <a href="{{ route('transactions.index') }}" class="btn btn-danger col-md-3">Cancelar</a>
                        <button type="reset" class="btn btn-warning col-md-3">Limpar Campos</button>
                        <button type="submit" class="btn btn-success col-md-3">Cadastrar Transação</button>
                    </div>


                </form>

            </div>
        </div>
    </div>

</div>

@endsection


@section('scripts')

@endsection