<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Exports\PlayersExport;
use Maatwebsite\Excel\Facades\Excel;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'description',
        'retired',
        'image',
    ];


    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
