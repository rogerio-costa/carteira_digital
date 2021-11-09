@extends('layouts.main')


@section('estilos')

@endsection


@section('titulo', 'Realizar Saque')


@section('conteudo')

<div class="container p-3">

    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header text-white bg-dark">
                Realizar saque
            </div>
            <div class="card-body">

                <form action="{{ route('saque.store') }}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label>Valor do saque</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="valor_saque" name="valor_saque"
                                placeholder="Exemplo: 100,00">
                        </div>
                    </div>
                    

                    <div class="container mb-3 text-center">
                        <a href="{{ route('contas.index') }}" class="btn btn-danger col-md-3">Cancelar</a>
                        <button type="reset" class="btn btn-warning col-md-3">Limpar Campos</button>
                        <button type="submit" class="btn btn-success col-md-3">Realizar Saque</button>
                    </div>


                </form>

            </div>
        </div>
    </div>

</div>

@endsection


@section('scripts')

@endsection