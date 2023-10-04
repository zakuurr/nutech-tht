@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{ asset('') }}assets/img/profile.jpg" alt="profile picture" class="rounded-circle object-fit-cover mb-3" width="150px" height="150px">
    <h3 class="mb-3">Reza Kurnia</h3>
    <div class="row">
      <div class="col-8">
        <label class="form-label fw-semibold">Nama Kandidat</label>
        <div class="rounded border p-2">
          @&ensp;Reza Kurnia
        </div>
      </div>
      <div class="col-4">
        <label class="form-label fw-semibold">Posisi Kandidat</label>
        <div class="rounded border p-2">
          &lt;/&gt;&ensp;Web Programmer
        </div>
      </div>
    </div>

</div>

@endsection
