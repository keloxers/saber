<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Categoria;
use App\Pregunta;
use App\Respuesta;


class RespuestaController extends Controller
{

  public function index($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $pregunta = Pregunta::find($id);
    $respuestas = Respuesta::where('preguntas_id',$id)->paginate(25);
    $title = "Pregunta: " . $pregunta->pregunta;
    return view('respuestas.index', ['pregunta' => $pregunta, 'respuestas' => $respuestas, 'title' => $title ]);

  }



    public function create($id)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $pregunta = Pregunta::find($id);

      $title = "Crear Respuestas para:";
      return view('respuestas.create', ['pregunta' => $pregunta, 'title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'preguntas_id' => 'required|exists:preguntas,id',
      ]);


      if ($validator->fails()) {
        foreach($validator->messages()->getMessages() as $field_name => $messages) {
          foreach($messages AS $message) {
            $errors[] = $message;
          }
        }
        return redirect()->back()->with('errors', $errors)->withInput();
        die;
      }

      $correcta = 0;
      if ($request->correcta=='on') { $correcta = 1; }

      $respuesta = new Respuesta;
      $respuesta->preguntas_id = $request->preguntas_id;
      $respuesta->respuesta = $request->respuesta;
      $respuesta->correcta = $correcta;
      $respuesta->activo = true;
      $respuesta->save();
      // return redirect('preguntas/' . $request->preguntas_id . '/respuestas');
      return redirect('respuestas/' . $request->preguntas_id . '/create');




    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $respuesta = Respuesta::find($id);
    $title = "Respuesta Editar";
    return view('respuestas.edit', ['respuesta' => $respuesta, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $validator = Validator::make($request->all(), [
      'respuesta' => 'required|max:125',

    ]);


    if ($validator->fails()) {
      foreach($validator->messages()->getMessages() as $field_name => $messages) {
        foreach($messages AS $message) {
          $errors[] = $message;
        }
      }
      return redirect()->back()->with('errors', $errors)->withInput();
      die;
    }

    $correcta = 0;
    if ($request->correcta=='on') { $correcta = 1; }

    $activo = 0;
    if ($request->activo=='on') { $activo = 1; }

    $respuesta = Respuesta::find($id);
    $preguntas_id = $respuesta->preguntas_id;
    $respuesta->respuesta = $request->respuesta;
    $respuesta->correcta = $correcta;
    $respuesta->activo = $activo;

    $respuesta->save();
    return redirect('/preguntas/' . $preguntas_id . '/respuestas');

  }




  public function destroy($id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $request = new Request([
      'id' => $id,
    ]);

    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:categorias,id',
    ]);


    if ($validator->fails()) {
      foreach($validator->messages()->getMessages() as $field_name => $messages) {
        foreach($messages AS $message) {
          $errors[] = $message;
        }
      }
      return redirect()->back()->with('errors', $errors)->withInput();
      die;
    }

    $categoria = Categoria::find($id);
    $categoria->delete();
    return redirect('/categorias/');


  }




    public function finder(Request $request){

      $categorias = Categoria::where('categoria', 'like', '%'. $request->buscar . '%')->paginate(25);


      $title = "categorias buscando: " . $request->buscar;
      return view('categorias.index', ['categorias' => $categorias, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = Categoria::where('categoria', 'like', '%'. $term . '%')->get();
    $adevol = array();
    if (count($datos) > 0) {
      foreach ($datos as $dato)
      {
        $adevol[] = array(
          'id' => $dato->id,
          'value' => $dato->categoria,
        );
      }
    } else {
      $adevol[] = array(
        'id' => 0,
        'value' => 'no hay coincidencias para ' .  $term
      );
    }
    return json_encode($adevol);
  }




  public function show($id)
  {

    $request = new Request([
      'id' => $id,
    ]);

    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:categorias,id',
    ]);

    if ($validator->fails()) {
      foreach($validator->messages()->getMessages() as $field_name => $messages) {
        foreach($messages AS $message) {
          $errors[] = $message;
        }
      }
      return redirect()->back()->with('errors', $errors)->withInput();
      die;
    }

    $categoria = Categoria::find($id);
    $title='categoria ver';
    return view('categorias.show', ['categoria' => $categoria, 'title' => $title]);

  }




}
