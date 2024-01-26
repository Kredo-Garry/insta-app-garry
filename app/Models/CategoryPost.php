<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    # connect to the category_post table
    protected $table = 'category_post';

    # define the table fields to use
    protected $fillable = ['post_id', 'category_id'];

    # set the timestamps to false because we don't want to use it
    public $timestamps = false;

    # Use this method to get the name of the category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
