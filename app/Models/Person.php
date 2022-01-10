<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'edited';

    protected $guarded = [];

    public function planet()
    {
        return $this->belongsTo(Planet::class, 'planet_id', 'id');
    }
}
