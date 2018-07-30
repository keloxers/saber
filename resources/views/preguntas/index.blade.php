@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>
      <a href="/categorias">
      <i class="fas fa-caret-square-left"></i>
      </a>
      {{$title}}</h1>

      <br>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      {{ Form::open(array('route' => 'preguntas.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('preguntas_id', '', array('id' => 'preguntas_id', 'name' => 'preguntas_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/preguntas/{{$categoria->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($preguntas)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Pregunta</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($preguntas as $pregunta)
      <tr>
        <td>
          <a href="/preguntas/{{ $pregunta->id }}/respuestas">
          {{ $pregunta->pregunta}}
          </a>
        </td>
        <td>
          @if ($pregunta->activo)
            <span class="badge badge-success">Activo</span>
          @else
            <span class="badge badge-danger">Inactivo</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/preguntas/{{ $pregunta->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/preguntas/{{ $pregunta->id }}/respuestas"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $preguntas->links() }}

  @endif

</div>
@endsection
