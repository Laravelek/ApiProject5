<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestaties extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'prestatie';
    protected $fillable = ['OefeningId','Aantal','UserId'];

}
