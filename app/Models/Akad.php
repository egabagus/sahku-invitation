<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akad extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "akad";
    public $timestamps = false;
    protected $guarded = [];
}
