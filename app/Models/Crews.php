<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crews extends Model
{
    public $timestamps = false;
    protected $fillable = [
        "crewid",
        "firstname",
        "lastname",
        "middlename",
        "email",
        "address",
        "education",
        "contactnumber",
    ];
}
