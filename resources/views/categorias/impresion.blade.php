
<?php
  use App\Pregunta;
  use App\Respuesta;
?>


  @if($categorias)


      @foreach ($categorias as $categoria)


      <h1>{{ $categoria->categoria}}</h1>

      <?php $preguntas = Pregunta::where('categorias_id', $categoria->id)->get(); ?>

      @if($preguntas)
          @foreach ($preguntas as $pregunta)

          <p><b>*) {{ $pregunta->pregunta}}</b>
            @if($pregunta->url_foto<>"")
              <b>( CON FOTO SUBIDA)</b>
            @endif
          </p>

          <?php $respuestas = Respuesta::where('preguntas_id', $pregunta->id)->get(); ?>



              @if($respuestas)<p>
                  @foreach ($respuestas as $respuesta)

                  {{ $respuesta->respuesta }}
                    @if($respuesta->correcta)
                      <b>( CORRECTA)</b>
                    @endif
                    /


                  @endforeach
                  </p>
              @endif


          @endforeach
      @endif


      @endforeach

  @endif
