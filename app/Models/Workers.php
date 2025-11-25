<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workers extends Model
{
    protected $table = "workers";
 
    protected $fillable = ['name', 'surname', 'company_id', 'email', 'phone'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
     
    }

}
