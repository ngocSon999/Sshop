<?php

namespace App\Models;

use  Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
//    use SoftDeletes;
    protected $table='products';
    protected $fillable=[
        'name',
        'price',
        'feature_image_path',
        'feature_image_name',
        'content',
        'user_id',
        'category_id',
    ];

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id')
            ->withTimestamps();
    }

    public function oders()
    {
        return $this->belongsToMany(Oder::class,'oder_details','product_id','oder_id');
    }


}
