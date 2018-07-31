<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Categoria;
use App\Pregunta;


class PreguntaController extends Controller
{

  public function index($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $categoria = Categoria::find($id);
    $preguntas = Pregunta::where('categorias_id',$id)->paginate(25);
    $title = "Categoria: " . $categoria->categoria;
    return view('preguntas.index', ['categoria' => $categoria, 'preguntas' => $preguntas, 'title' => $title ]);

  }



    public function create($id)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $categoria = Categoria::find($id);

      $title = "Crear Pregunta";
      return view('preguntas.create', ['categoria' => $categoria, 'title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'categorias_id' => 'required|exists:categorias,id',
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

      $activo = 0;
      if ($request->activo=='on') { $activo = 1; }

      $pregunta = new Pregunta;
      $pregunta->categorias_id = $request->categorias_id;
      $pregunta->pregunta = $request->pregunta;
      $pregunta->activo = $activo;
      $pregunta->save();
      return redirect('/categorias/' . $request->categorias_id . '/preguntas');



    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $pregunta = Pregunta::find($id);
    $title = "pregunta Editar";
    return view('preguntas.edit', ['pregunta' => $pregunta, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $validator = Validator::make($request->all(), [
      'pregunta' => 'required|unique:preguntas,pregunta,'.$id,

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

    $activo = 0;
    if ($request->activo=='on') { $activo = 1; }

    $pregunta = Pregunta::find($id);
    $categorias_id = $pregunta->categorias_id;
    $pregunta->pregunta = $request->pregunta;
    $pregunta->activo = $activo;
    $pregunta->save();
    return redirect('/categorias/' . $categorias_id . '/preguntas');

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
