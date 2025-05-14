<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class animal extends Model
{
    use HasFactory;
    protected $table = 'animal';

    protected $fillable = ['name', 'age', 'date', 'animal_type', 'id_user'];

}
