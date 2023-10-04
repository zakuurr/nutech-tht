<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.head')
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
              @include('layouts.partials.sidebar')
              <main class="col p-4">

                @yield('content')
              </main>
            </div>
          </div>
    </div>

    @include('layouts.partials.js')

</body>
</html>
