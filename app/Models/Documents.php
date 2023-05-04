<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = [
        "documentid",
        "code",
        "crewid",
        "name",
        "documentnumber",
        "dateissued",
        "dateexpiry",
    ];
}
