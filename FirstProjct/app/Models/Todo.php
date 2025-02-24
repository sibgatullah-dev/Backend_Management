<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{


    protected $fillable = [
        'status',
        'comments',
    ];
    // Relation with User Model
    function rel_to_user(){
        return $this->belongsTo(User::class, 'assigned_by',);
    }
    function rel_to_user2(){
        return $this->belongsTo(User::class, 'assigned_to',);
    }
}
