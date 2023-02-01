<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table='offers';

    protected $fillable=['id','title','description','date_max','num_candidates','cicle_id','deleted','created_at','updated_at'];

    public function apply(){
        return $this->hasMany(Applied::class);
    }

}
