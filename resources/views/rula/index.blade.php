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
      <h1 class="display-3">
      {{$title}}
    </h1>
    </div>
      <br>
    </div>
  </div>

  <br><br>

  @if($pregunta)

  <h1>
    {{$pregunta->pregunta}} ?
  </h1>

  <br><br>

  @if($respuestas)
    @foreach ($respuestas as $respuesta)
        <a href="/rula/{{ $respuesta->id }}/escorrecta">
          <i class="far fa-check-square"></i> {{ $respuesta->respuesta}}
        </a>
      <br><br>

    @endforeach
  @endif

  <div>
    @if ($pregunta->url_foto<>"")

    <img src="{{Storage::url($pregunta->url_foto)}}" class="img-fluid" alt="Responsive image">

    @endif
  </div>


  @endif

</div>
@endsection
