@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>{{$title}}</h1>
      <br>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      {{ Form::open(array('route' => 'respuestas.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('respuestas_id', '', array('id' => 'respuestas_id', 'name' => 'respuestas_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/respuestas/{{$pregunta->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($respuestas)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Respuesta</th>
        <th scope="col">Correcta</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($respuestas as $respuesta)
      <tr>
        <td>
          {{ $respuesta->respuesta}}
        </td>
        <td>
          @if ($respuesta->correcta)
            <span class="badge badge-success">Si</span>
          @else
            <span class="badge badge-danger">No</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/respuestas/{{ $respuesta->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/respuestas/{{ $respuesta->id }}/respuestas"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $respuestas->links() }}

  @endif

</div>
@endsection
