<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class BookController extends Controller
{

    use ApiResponser;

    public function getAll(){

        $books = Book::all();

        return $this->successResponse($books);

    }

    public function nuevoBook(Request $request){

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1'
        ];

        $this->validate($request, $rules);//Habría que hacer algo en caso de que no validara

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);

    }

    public function getBookById($id_book){
        
        $book = Book::findOrFail($id_book);

        return $this->successResponse($book);
    }

    public function update(Request $request, $id_book){

        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
            'price' => 'min:1',
            'author_id' => 'min:1'
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($id_book);//Obtenemos el registro

        $book->fill($request->all());//Rellenamos los datos co la petición

        if($book->isClean()){//Si no se ha cambiado nada en el objeto delvemos error
            return $this->errorResponse('Se debe modificar al menos un valor', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();//Actualizamos

        return $this->successResponse($book);

    }

    public function delete($id_book){

        $book = Book::findOrFail($id_book);

        $book->delete();

        return $this->successResponse($book);

    }

    //
}
