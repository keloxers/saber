
<?php
  use App\Pregunta;
  use App\Respuesta;
?>


  @if($categorias)

  <table class="table">
    <tbody>


      @foreach ($categorias as $categoria)
      <tr>

      <h1>{{ $categoria->categoria}}</h1>

      <?php $preguntas = Pregunta::where('categorias_id', $categoria->id)->get(); ?>

      @if($preguntas)
          @foreach ($preguntas as $pregunta)


          <td>
          <p><b>*) {{ $pregunta->pregunta}}</b>
            @if($pregunta->url_foto<>"")
              <b>( CON FOTO SUBIDA)</b>
            @endif
          </p>
          </td>
          <?php $respuestas = Respuesta::where('preguntas_id', $pregunta->id)->get(); ?>



              @if($respuestas)<p>
                  @foreach ($respuestas as $respuesta)
                  <td>
                  {{ $respuesta->respuesta }}
                    @if($respuesta->correcta)
                      <b>( CORRECTA)</b>
                    @endif
                  </td>
                  @endforeach
                  </p>
              @endif


          @endforeach
      @endif

      </tr>
      @endforeach

    </tbody>
  </table>


  @endif
