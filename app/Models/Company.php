<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $table = "company";
    //
    protected $fillable = ['name', 'adress', 'postcode', 'city', 'nip'];

    public function workers(): HasMany
    {
        return $this->hasMany(workers::class);
 
    }    

}
