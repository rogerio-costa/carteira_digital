<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- CSS da Aplicação -->
  @yield('estilos')

  <title>@yield('titulo')</title>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="{{ route('accounts.index') }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
        <path
          d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
        <path
          d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
      </svg>
      Carteira Digital
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
      aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">

        {{--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="historicoDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Histórico
          </a>
          <div class="dropdown-menu" aria-labelledby="historicoDropdown">
            <a class="dropdown-item" href="#">Meus depósitos</a>
            <a class="dropdown-item" href="#">Meus saques</a>
          </div>
        </li>
        --}}

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="transacoesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Transações
          </a>
          <div class="dropdown-menu" aria-labelledby="transacoesDropdown">
            <a class="dropdown-item" href="{{ route('transactions.create') }}">Cadastrar uma transação</a>
            <a class="dropdown-item" href="{{ route('transactions.index') }}">Minhas transações</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="transacoesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Tipos de Transações
          </a>
          <div class="dropdown-menu" aria-labelledby="transacoesDropdown">
            <a class="dropdown-item" href="{{ route('transaction_types.create') }}">Cadastrar um tipo de transação</a>
            <a class="dropdown-item" href="{{ route('transaction_types.index') }}">Tipos de transação</a>
          </div>
        </li>

      </ul>

    </div>

    <div class="navbar-collapse collapse">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="usuarioNavbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Bem vindo(a) {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="usuarioNavbarDropdown">

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a lass="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              this.closest('form').submit();">Sair</a>
            </form>

          </div>
        </li>

      </ul>
    </div>

  </nav>


  <!-- MENSSAGENS -->
  @if (session('success'))
  <div class="container-fluid p-3">
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
  </div>
  @endif


  <!-- FIM MENSSAGENS -->
  @if ($errors->any())
  @foreach ($errors->all() as $error)
  <div class="container-fluid p-3">
    <div class="alert alert-danger" role="alert">
      {{ $error }}
    </div>
  </div>
  @endforeach
  @endif

  @yield('conteudo')

  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
    integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
  </script>


  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <!-- JS da Aplicação -->
  @yield('scripts')

</body>

</html>