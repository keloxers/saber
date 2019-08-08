<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;
use App\Pregunta;
use App\Respuesta;


class RulaController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categoria)
    {

        $categoria = Categoria::where('categoria', $categoria)->first();

        // echo $categoria->id;
        // return view('home');

        $disponible = false;

        $pregunta = Pregunta::where('categorias_id', $categoria->id)
                            ->where('activo', true)
                            ->inRandomOrder()
                            ->first();

        if (!$pregunta) {
          $title = 'NO HAY MAS PREGUNTAS EN ESTA CATEGORIA';
          return view('rula.noindex', ['title' => $title ]);
        }

        $pregunta_marcar = Pregunta::find($pregunta->id);
        $pregunta_marcar->activo = false;
        $pregunta_marcar->save();


        $respuestas = Respuesta::where('preguntas_id', $pregunta->id)
                            ->get();



        $title = $categoria->categoria;

        return view('rula.index', ['pregunta' => $pregunta, 'respuestas' =>$respuestas, 'title' => $title ]);



    }




/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
public function escorrecta($respuestas_id)
{

    $respuesta = Respuesta::find($respuestas_id);
    $pregunta = Pregunta::find($respuesta->preguntas_id);


    $title = $pregunta->pregunta;


  return view('rula.escorrectaindex', ['title' => $title,
                                       'respuesta' => $respuesta,
                                       'pregunta' => $pregunta
                                     ]);

}

}
