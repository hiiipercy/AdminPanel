<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','category_id','order_by','status'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->withDefault(['name'=>'N/A']);
    }

    public function post(){
        return $this->hasMany(Post::class,'sub_category_id','id');
    }
}
