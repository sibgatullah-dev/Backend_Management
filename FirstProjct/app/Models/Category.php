<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'category_image',
        'slug',
    ];
    use SoftDeletes;

    function rel_to_subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
}
