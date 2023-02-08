<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\articles;
use App\Cicles;
use WithFileUploads;

class ArticlesController extends Controller
{
    

    public function index(Request $request){

        $articles=articles::paginate(10);
        
		return view('articles', compact('articles'));
		
	}
    
}