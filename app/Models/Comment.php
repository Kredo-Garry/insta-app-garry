<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // To retrieve the information about the comment's owner
    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
        // A comment belongs to a User. Witht this , we can retrieve the name of the owner of the comment
    }
}
