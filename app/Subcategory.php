<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name', 'description', 'category_id'
    ];

    public function users(){
        return $this->belongsToMany(User::Class);
    }
}
