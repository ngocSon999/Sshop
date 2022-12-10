<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable=[
        'user_id',
        'product_id',
        'name',
        'email',
        'description',
        'content',
        'comment_status',
        'parent_comment_id'
    ];

    public function users()
    {
    return $this->belongsTo(User::class,'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function parentComment()
    {
        return $this->hasMany(Comment::class,'parent_comment_id');
    }
}
