<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year_of_graduation extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
    ];
}
