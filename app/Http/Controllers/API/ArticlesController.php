<?php

namespace App\Http\Controllers\API;
use App\Articles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public $successStatus = 200;

    public function index() {
        $articles = Articles::all();

        return response()->json(['Articulos' => $articles->toArray()], $this->successStatus);
    }

    public function store(Request $request) {
        $input = $request->all();

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cicle_id' => 'required',
        ]);
    

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);       
        }

        $article = Articles::create($input);

        return response()->json(['Articulos' => $article->toArray()], $this->successStatus);
    }

    public function show($id) {
        $article = Articles::find($id);

        if (is_null($article)) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        return response()->json(['Articulos' => $article->toArray()], $this->successStatus);
    }

    public function update(Request $request, Articles $article) {
        $input = $request->all();

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cicle_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);       
        }

        $article->title = $input['title'];
        $article->description = $input['description'];
        $article->cicle_id = $input['cicle_id'];
        $article->save();

        return response()->json(['Articulos' => $article->toArray()], $this->successStatus);
    }

    public function destroy(Articles $article) {
        $article->delete();

        return response()->json(['Articulos' => $article->toArray()], $this->successStatus);
    }
}
