<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{

    use ApiResponser;

    public function getAll(){

        $authors = Author::all();

        return $this->successResponse($authors);

    }

    public function nuevoAutor(Request $request){

        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255'
        ];

        $this->validate($request, $rules);//Habría que hacer algo en caso de que no validara

        $autor = Author::create($request->all());

        return $this->successResponse($autor, Response::HTTP_CREATED);

    }

    public function getAutorById($id_autor){
        
        $author = Author::findOrFail($id_autor);

        return $this->successResponse($author);
    }

    public function update(Request $request, $id_autor){

        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255'
        ];

        $this->validate($request, $rules);

        $autor = Author::findOrFail($id_autor);//Obtenemos el registro

        $autor->fill($request->all());//Rellenamos los datos co la petición

        if($autor->isClean()){//Si no se ha cambiado nada en el objeto delvemos error
            return $this->errorResponse('Se debe modificar al menos un valor', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $autor->save();//Actualizamos

        return $this->successResponse($autor);

    }

    public function delete($id_autor){

        $autor = Author::findOrFail($id_autor);

        $autor->delete();

        return $this->successResponse($autor);

    }

    //
}
