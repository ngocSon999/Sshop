<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory;
//    use SoftDeletes;
    protected $table='categories';
    protected $fillable=[
      'name',
      'parent_id',
      'slug'
    ];

    public function categoryChildrent()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
}
