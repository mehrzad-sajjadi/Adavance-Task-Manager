<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post as Post;


class Category extends Model
{
    use HasFactory;

    
    protected $fillable=[
        "name",
        "user_id",
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
