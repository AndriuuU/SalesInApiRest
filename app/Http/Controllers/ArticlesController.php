<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Articles;
use App\Cicles;
use WithFileUploads;

class ArticlesController extends Controller
{
    

    public function index(Request $request){

        $articles=Articles::paginate(10);
		return view('articles.index', compact('articles'));
		// return view('articles.index');
		
	}

	public function create() {
		$cicles=cicles::all();
    
        return view('articles.create', compact('cicles'));
    }

	protected function store(Request $request)
    {
       
        $this->validate(request(), [
            'title' => 'required|max:255|unique:articles', //Creo que lo de unico hay que quitarlo (NO SE)
            'description' =>'required|max:255',
            'cicle_id' => 'required',
            // 'image' => 'required|image|mimes:jpg,png,jpeg',	
        ]);
        $article = new Articles; 
        $article->title         = $request->get('title');
        $article->description = $request->get('description');
        $article->cicle_id     = $request->get('cicle_id');
        
        $file = $request->file('image');

        $nombre = $request->get('title');
        $nombreImage = Str::slug($request->title).".".$file->guessExtension();
        $ruta = public_path("images/");
        $file->move($ruta, $nombreImage);

        $article->image = $nombreImage;

        $article->save();

        return redirect()->route('articles.index')->with('message','FELICIDADES! Noticia creada correctamente');

    }


	protected function validator(Request $request)
    {   
        return Validator::make($request, [
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'description' => ['required', 'string', 'max:255'],
            'cicle_id' => ['required', 'int'],
        ]);
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($articles = $this->create($request->all())));

        return redirect($this->redirectPath())->with('message', 'Se insertó correctamente');
    }

    public function editar(Articles $article)
    {   
        // $article = Auth::article();
        
        $article=Articles::find($article->id);
        $cicles=cicles::all();
        return view('articles.edit', compact('article','cicles'));
        //return view('articles.edit');
    }

	public function update(Articles $article,Request $request)
    { 
        
        $this->validate(request(), [
				'title' => 'required|max:255', 
                'description' =>'required|max:255',
                'cicle_id' => 'required',
				// 'image' => 'required|image|mimes:jpg,png,jpeg',	
            ]);

            $article->title = request('title');
            $article->description = request('description');
            $article->cicle_id = request('cicle_id');
			
            $file = $article->image;
            $ruta = public_path("images/");
            if($request->image!=Null){
                if (@getimagesize("images/".$file)) {
                    unlink("images/".$file);
                }
            }
           
            $fileCopy=$request->file('image');
            $nombreImage = Str::slug($request->title).".".$fileCopy->guessExtension();
            $fileCopy->move($ruta, $nombreImage);
            // $nombre = request('title');
            // $nombreImage = Str::slug($nombre).".".$file->guessExtension();
            // $ruta = public_path("images/");
            // $file->move($ruta, $nombreImage);

            $article->image = $nombreImage;

            $article->save();
            // return back();
        return redirect()->route('articles.index')->with('message','FELICIDADES! Noticia actualizada correctamente');
    }

    public function eliminar(Articles $article) {
		$article = Articles::find($article->id);
        $file = $article->image;
        if (@getimagesize("images/".$file)) {
            unlink("images/".$file);
        }
        $article->deleted = 1;
        $article->update();

        return redirect()->route('articles.index')->with('message','FELICIDADES! Noticia eliminado correctamente');
    }
    
}