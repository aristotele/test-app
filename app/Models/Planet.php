<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'edited';

    protected $guarded = [];

    public function residents()
    {
        return $this->hasMany(Person::class);
    }
}
