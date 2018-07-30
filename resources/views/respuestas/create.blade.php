@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1>
            <a href="/preguntas/{{$pregunta->id}}/respuestas">
              <i class="fas fa-caret-square-left"></i>
            </a>
            {{ $title }}
          </h1>
          <h4>{{$pregunta->pregunta}} ?</h4>
        </div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('route' => 'respuestas.store',  'autocomplete' => 'off')) }}
                {{ Form::hidden('preguntas_id', $pregunta->id, array('id' => 'preguntas_id', 'name' => 'preguntas_id')) }}
                <div class="form-group">
                  <label for="">Respuesta</label>
                  <input type="respuesta" class="form-control" name="respuesta" id="respuesta" placeholder="Ingrese el nombre del respuesta">
                </div>
                <div class="form-group">
                  <label for="activo">Correcta</label>
                  <input type="checkbox" data-toggle="toggle" name="correcta" id="correcta">
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                {{ Form::close() }}
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>




@stop
