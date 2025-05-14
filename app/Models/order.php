<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = ['name','product_id','quantity','price'];

}
