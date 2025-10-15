<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    protected $table = "workers";
 
    protected $fillable = ['name', 'surname', 'company_id', 'email', 'phone'];
}
