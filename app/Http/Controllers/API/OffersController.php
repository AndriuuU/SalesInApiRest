<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Validator;


class OffersController extends Controller
{
    public $successStatus = 200;

    public function index() {
        $offers = Offers::all();

        return response()->json(['Success'=>True,'Ofertas' => $offers->toArray()], $this->successStatus);
    }

    public function store(Request $request) {
        $input = $request->all();

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date_max' => 'required',
            'num_candidates' => 'required',
            'cicle_id' => 'required'
        ]);
    

        if(is_null($validatedData)){
            return response()->json(['Success'=>False,'error' => $validatedData->errors()], 401);       
        }

        $offer = Offers::create($input);

        return response()->json(['Success'=>True,'Ofertas' => $offer->toArray()], $this->successStatus);
    }

    public function show($id) {
        $offer = Offers::find($id);

        if (is_null($offer)) {
            return response()->json(['Success'=>False,'error' => $validator->errors()], 401);
        }

        return response()->json(['Success'=>True,'Ofertas' => $offer->toArray()], $this->successStatus);
    }

    public function update(Request $request, Offers $offer) {
        $input = $request->all();

        $validatedData = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'date_max' => 'required',
            'num_candidates' => 'required',
            'cicle_id' => 'required'
        ]);

        if(is_null($validatedData)){
            return response()->json(['Success'=>False,'error' => $validatedData->errors()], 401);       
        }

        $offer->title = $input['title'];
        $offer->description = $input['description'];
        $offer->date_max = $input['date_max'];
        $offer->num_candidates = $input['num_candidates'];
        $offer->cicle_id = $input['cicle_id'];
        $offer->save();

        return response()->json(['Success'=>True,'Ofertas' => $offer->toArray() ], $this->successStatus);
    }

    public function destroy(Offers $offer) {
        $offer->delete();

        return response()->json(['Success'=>True,'Ofertas' => $offer->toArray()], $this->successStatus);
    }
}
