<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $fillable = ['name','slug','order_by','status'];
    use HasFactory;
    
    public function sub_categories(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

    public function post(){
        return $this->hasMany(Post::class,'post_id','id');
    }
}
