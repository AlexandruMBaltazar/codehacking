<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    public function getProfilePic ($fileName){
        return asset('images/'. $fileName);
    }

}
