<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    # To get the number of categories under each post
    public function categoryPost(){
        return $this->hasMany(categoryPost::class);
    }
}
