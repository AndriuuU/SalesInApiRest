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

        return response()->json(['Ofertas' => $offers->toArray()], $this->successStatus);
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
    

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);       
        }

        $offer = Offers::create($input);

        return response()->json(['Ofertas' => $offer->toArray()], $this->successStatus);
    }

    public function show($id) {
        $offer = Offers::find($id);

        if (is_null($offer)) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        return response()->json(['Ofertas' => $offer->toArray()], $this->successStatus);
    }

    public function update(Request $request, Offers $offer) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);       
        }

        $offer->name = $input['name'];
        $offer->detail = $input['detail'];
        $offer->save();

        return response()->json(['Ofertas' => $offer->toArray()], $this->successStatus);
    }

    public function destroy(Offers $offer) {
        $offer->delete();

        return response()->json(['Ofertas' => $offer->toArray()], $this->successStatus);
    }
}
