<?php

namespace App\Http\Controllers\API;
use App\Articles;
use App\Cicles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public $successStatus = 200;

    public function index() {
        
        $articles = Articles::all();

        return response()->json(['Success'=>True,'Articulos' => $articles->toArray()]);
    }

    public function store(Request $request) {
        $input = $request->all();

        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'cicle_id' => 'required',
        ]);
    

        if(is_null($validatedData)){
            return response()->json(['error' => $validatedData->errors()], 401);       
        }

        $article = Articles::create($input);

        return response()->json(['Success'=>True,'Articulos' => $article->toArray()], $this->successStatus);
    }

    public function show($id) {
        $article = articles::find($id);

        if (is_null($article)) {
            return response()->json(['Success'=>False,'error' => $validator->errors()], 401);
        }

        return response()->json(['Success'=>True,'Articulos' => $article->toArray()], $this->successStatus);
    }

    public function update(Request $request, Articles $article) {
        $input = $request->all();

        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'cicle_id' => 'required'
        ]);

        if(is_null($validatedData)){
            return response()->json(['Success'=>False,'error' => $validatedData->errors()], 401);       
        }

        $article->title = $input['title'];
        $article->image = $input['image'];
        $article->description = $input['description'];
        $article->cicle_id = $input['cicle_id'];
        $article->save();

        return response()->json(['Success'=>True,'Articulos' => $article->toArray()], $this->successStatus);
    }

    public function destroy(Articles $article) {
        $article->delete();

        return response()->json(['Success'=>True,'Articulos' => $article->toArray()], $this->successStatus);
    }
}
