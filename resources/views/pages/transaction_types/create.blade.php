@extends('layouts.main')


@section('estilos')

@endsection


@section('titulo', 'Cadastro de um Tipo de Transação')


@section('conteudo')

<div class="container p-3">

    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header text-white bg-dark">
                Cadastrar um Tipo de Transação
            </div>
            <div class="card-body">

                <form action="{{ route('transaction_types.store') }}" method="POST">

                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-8">
                          <label for="name">Nome do tipo da transação</label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="type_of">Tipo da operação</label>
                          <select id="type_of" name="type_of" class="form-control">
                            <option value="0" selected>Entrada</option>
                            <option value="1">Saída</option>
                          </select>
                        </div>
                      </div>
                    

                    <div class="container mb-3 text-center">
                        <a href="{{ route('transaction_types.index') }}" class="btn btn-danger col-md-3">Cancelar</a>
                        <button type="reset" class="btn btn-warning col-md-3">Limpar Campos</button>
                        <button type="submit" class="btn btn-success col-md-3">Cadastrar o Tipo de Transação</button>
                    </div>


                </form>

            </div>
        </div>
    </div>

</div>

@endsection


@section('scripts')

@endsection