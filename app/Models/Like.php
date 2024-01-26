<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public $timestamps = false; // we don't need to use $timestamps that is why we deleted in the migration file, and we set it to false here in the model
}
