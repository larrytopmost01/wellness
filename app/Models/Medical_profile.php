<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name_of_university',
        'year_of_graduation',
        'certificate',
        'year_of_collection',
        'liensence',
    ];
}
