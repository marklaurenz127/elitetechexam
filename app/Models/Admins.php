<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    public $id = false;
    public $timestamps = false;
    protected $fillable = [
        "username",
        "password"
    ];
}
