<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use \Astrotomic\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = [
        'slug', 'user_id'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    // (optionaly)
    // protected $with = ['translations'];

}
