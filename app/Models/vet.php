<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vet extends Model
{
    protected $table = 'vet';
    public $timestamps = false;

    protected $fillable = ['name'];
}
