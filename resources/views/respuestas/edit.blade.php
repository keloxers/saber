@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>{{ $title }}</h1></div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('url' => URL::to('respuestas/' . $respuesta->id), 'method' => 'PUT', 'role' => 'form')) }}
                <div class="form-group">
                  <label for="">respuesta</label>
                  {{ Form::text('respuesta', $respuesta->respuesta, array('id' => 'respuesta', 'name' => 'respuesta', 'class' => "form-control" , 'placeholder' => 'Ingrese un respuesta')) }}
                </div>
                <div class="form-group">
                  <label for="activo">Correcta</label>
                  <input type="checkbox" data-toggle="toggle" name="correcta" id="correcta"
                  @if ($respuesta->correcta)
                    checked
                  @endif
                  >

                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo"
                  @if ($respuesta->activo)
                    checked
                  @endif
                  >

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
