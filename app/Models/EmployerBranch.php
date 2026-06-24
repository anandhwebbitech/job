<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerBranch extends Model
{
    //
    protected $guarded = [];

    public function branches()
    {
        return $this->hasMany(EmployerBranch::class, 'employer_id');
    }
}
