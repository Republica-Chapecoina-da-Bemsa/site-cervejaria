<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">Dom Guri</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('styles.*') ? 'active' : '' }}" href="{{ route('styles.list') }}">Estilos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.list') }}">Produtos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.index') }}">ADMIN</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
      </ul>
    </div>
  </div>
</nav>
