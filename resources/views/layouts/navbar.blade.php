<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">ERP System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @role('admin')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.index') }}">Products</a>
        </li>
        @endrole
        <li class="nav-item">
          <a class="nav-link" href="{{ route('sales-orders.index') }}">Sales Orders</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-link nav-link" type="submit">Logout</button>
          </form>
        </li>
        @endauth
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
