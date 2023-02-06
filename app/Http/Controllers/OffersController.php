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
        $offers = Offers::select('offers.id', 'offers.title', 'offers.description', 'offers.num_candidates','offers.cicle_id', 'offers.created_at', 'offers.updated_at', 'offers.deleted', 'applieds.offer_id', 'applieds.user_id')
                ->leftJoin('applieds', function($join) use ($userId) {
                 $join->on('offers.id', '=', 'applieds.offer_id')
                      ->where('applieds.user_id', '=', $userId);
              })
              ->whereNull('applieds.id')
              ->where('offers.deleted', 0)
              ->get();
        $cicles=cicles::all();
		
		$applies=Applied::where('user_id','!=',auth()->id())->with(['offer'])->paginate(10);
		return view('offers.index', compact('offers','cicles'));

	}

    // public function show($id)
    // {
    //     $offers = Offers::find($id);
    //     return view('offers.show', ['offers' => $offers]);
    // }
    
    // public function download(Request $request)
    // {
    //     $email = $request->input('email');
    //     $data = [
    //         'titulo' => 'Styde.net'
    //     ];

    //     $pdf = PDF::loadView('pdf', $data);
        
    //     Mail::send('emails.pdf', [], function ($m) use ($email, $pdf) {
    //         $m->to($email)->subject('Your PDF');
    //         $m->attachData($pdf->output(), "archivo.pdf", [
    //             'mime' => 'application/pdf',
    //         ]);
    //     });
    // }

    public function download()
	{
		$data = [
			'titulo' => 'Styde.net'
		];
		
		return PDF::loadView('pdf', $data)
			->stream('archivo.pdf');
        return redirect()->route('offers.index')->with('message','Oferta guardada con exito');
	}

    public function aplicar(Request $request,Offers $offer){
        $user = $request->user();
		$oferta = Offers::find($offer->id);
        //$applied = Applied::all();
		
		
        $appliednew = new Applied; 
        $appliednew->offer_id = $oferta->id;
        $appliednew->user_id = $user->id;
        
		$appliednew->save();

		$oferta->num_candidates=1+$oferta->num_candidates;
		$oferta->save();


        // $userId = auth()->id();
        // $offers = Offers::select('offers.id', 'offers.title', 'offers.description', 'offers.num_candidates', 'offers.created_at', 'offers.updated_at', 'offers.deleted', 'applieds.offer_id', 'applieds.user_id')
        //         ->leftJoin('applieds', function($join) use ($userId) {
        //          $join->on('offers.id', '=', 'applieds.offer_id')
        //               ->where('applieds.user_id', '=', $userId);
        //       })
        //       ->whereNull('applieds.id')
        //       ->where('offers.deleted', 0)
        //       ->get();
              
        
        // $cicles=cicles::all();


        // if($applied->offer_id == $id && $applied->user_id == $user){

			
				return redirect()->route('offers.index')->with('message', 'FELICIDADES! Oferta aplicada correctamente');
				
			
				return redirect()->route('offers.index')->with('messageError', 'ERROR!!! Oferta no aplicada');
			
		
			$user->actived = 0;
			$offer->deleted = 1;
			$offer->update();
			return redirect()->route('offers.index');
	}

        
		// return view('offers.index', compact('offers','cicles'));

	

    public function show(Request $request,Offers $offer) {
        $user = $request->user();
        $offers=Offers::find($offer->id);
        $cicles=cicles::all();
		
		return view('offers.show', compact('offers','cicles'));

	}
}