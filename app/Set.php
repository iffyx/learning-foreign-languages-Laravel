<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = [
        'name', 'set', 'language1_id', 'language2_id', 'number_if_words', 'subcategory_id'
    ];
}
