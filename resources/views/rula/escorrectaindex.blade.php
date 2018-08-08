@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-6">

    </div>
    <div class="col-6 text-right">
      <a href="/home">
        <button type="button" class="btn btn-primary"><i class="fas fa-caret-square-left"></i> Home</button>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="alert alert-primary" role="alert">
      <h1>

      {{$title}} ?

    </h1>
    </div>
      <br>
    </div>
  </div>



  <div class="row">
    <div class="col-12">

      <h1 class="display-5">
        {{$respuesta->respuesta}}
      </h1>

        <h1 class="display-3">
          @if ($respuesta->correcta)
              <div class="alert alert-primary" role="alert">
                CORRECTA !
              </div>
          @else
          <div class="alert alert-danger" role="alert">
                INCORRECTA
          </div>

          @endif

    </h1>

      <br>
    </div>
  </div>



</div>
@endsection
