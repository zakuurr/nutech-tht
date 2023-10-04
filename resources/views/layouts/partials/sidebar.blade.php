<div class="col-auto col-sm-2 col-md-3 col-xl-2 p-0 bg-danger min-vh-100">
    <div class="d-flex flex-column">
      <a href="" class="text-decoration-none fw-semibold text-white px-3 py-4 ">
        <img src="{{ asset('') }}assets/img/Handbag.png" alt="Logo.png" class="me-2" width="20" height="20">
        SIMS Web App
      </a>
      <a href="{{ route('product.index') }}" class="text-decoration-none text-white mb-2 px-3 py-1 {{ request()->is('product*') ? 'active' : '' }}" id="product">
        <img src="{{ asset('') }}assets/img/Package.png" alt="Package.png" class="me-2" width="20" height="20">
        Produk
      </a>
      <a href="/profil" class="text-decoration-none text-white mb-2 px-3 py-1 {{ request()->is('profil') ? 'active' : '' }}" id="profile" width="20" height="20">
        <img src="{{ asset('') }}assets/img/User.png" alt="User.png" class="me-2">
        Profil
      </a>
      <a href="/logout" class="text-decoration-none text-white mb-2 px-3 py-1" width="20" height="20">
        <img src="{{ asset('') }}assets/img/SignOut.png" alt="SignOut.png" class="me-2">
        Logout
      </a>
    </div>
  </div>
