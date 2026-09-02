<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name_bn', 'name_en', 'division_bn', 'division_en'];
}
