@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                      <div class="col-12">
                        <a href="/rula">
                          <button type="button" class="btn btn-primary">Ruleta</button>
                        </a>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-12">
                        <br><br><br>
                        <h1> Categorias</h1>
                        <br>
                        <a href="/rula/virasoro">
                          <button type="button" class="btn btn-primary">Virasoro</button>
                        </a>
                        <a href="/rula/corrientes">
                          <button type="button" class="btn btn-primary">Corrientes</button>
                        </a>
                        <a href="/rula/geografia">
                          <button type="button" class="btn btn-primary">Geografia</button>
                        </a>
                        <a href="/rula/historia">
                          <button type="button" class="btn btn-primary">Historia</button>
                        </a>
                        <br><br>
                        <a href="/rula/ciencia">
                          <button type="button" class="btn btn-primary">Ciencia</button>
                        </a>
                        <a href="/rula/deportes">
                          <button type="button" class="btn btn-primary">Deportes</button>
                        </a>
                        <a href="/rula/arte">
                          <button type="button" class="btn btn-primary">Arte</button>
                        </a>


                      </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
