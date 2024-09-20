<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category as Category;
use App\Models\User as User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;


    protected $fillable=[
        "name",
        "content",
        "category_id "
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
        // return $this->hasOne(Category::class);
    }
    public $appends=["category_name"];


    public function getCategoryNameAttribute(){
        return $this->category->name;
    }
    



}
