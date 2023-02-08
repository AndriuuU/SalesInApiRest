<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Cicles;
use App\Offers;
use App\Applied;
use WithFileUploads;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class OffersController extends Controller
{
    

    public function index(Request $request){

        $userId = auth()->id();
        $offers = Offers::select('offers.id', 'offers.title', 'offers.description', 'offers.num_candidates','offers.date_max','offers.cicle_id', 'offers.created_at', 'offers.updated_at', 'offers.deleted', 'applieds.offer_id', 'applieds.user_id')
                ->leftJoin('applieds', function($join) use ($userId) {
                 $join->on('offers.id', '=', 'applieds.offer_id')
                      ->where('applieds.user_id', '=', $userId);
              })
              ->whereNull('applieds.id')
              ->where('offers.deleted', 0)
              ->get();
        $cicles=cicles::all();
		
		$applies=Applied::where('user_id','!=',auth()->id())->with(['offer'])->paginate(10);
		return view('offers', compact('offers','cicles'));

	}


}