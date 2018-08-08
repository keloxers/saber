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




</div>
@endsection
