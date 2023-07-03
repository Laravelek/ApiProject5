<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oefening extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['Naam', 'Beschrijving', 'Stappen'];
    protected $table = 'oefening';

}
