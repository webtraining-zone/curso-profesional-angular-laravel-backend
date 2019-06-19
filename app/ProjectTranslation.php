<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{

    public $timestamps = false;
    protected $fillable = ['title', 'description'];

}
