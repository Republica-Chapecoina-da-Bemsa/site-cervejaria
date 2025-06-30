<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">Dom Guri</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.index') }}">Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('styles.index') }}">Estilos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('events.index') }}">Eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('clients.index') }}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('recipts.index') }}">Recibos</a>
        </li>
           <li class="nav-item">
          <a class="nav-link" href="{{ route('suppliers.index') }}">Fornecedores</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
