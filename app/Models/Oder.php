<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;
    protected $table='oders';
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'address',
        'phone',
        'note'
    ];

    public function oderDetail()
    {
        return $this->hasMany(OderDetail::class,'oder_id','id');
    }
}
