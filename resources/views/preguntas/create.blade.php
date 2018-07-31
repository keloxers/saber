@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1>
            {{ $title }}
          </h1>
        </div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('route' => 'preguntas.store',  'autocomplete' => 'off')) }}
                {{ Form::hidden('categorias_id', $categoria->id, array('id' => 'categorias_id', 'name' => 'categorias_id')) }}
                <div class="form-group">
                  <label for="">Pregunta</label>
                  <input type="pregunta" class="form-control" name="pregunta" id="pregunta" placeholder="Ingrese pregunta">
                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo" checked>
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
