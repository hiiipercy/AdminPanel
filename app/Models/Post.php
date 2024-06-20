<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->withDefault(['name'=>'N/A']);
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id','id')->withDefault(['name'=>'N/A']);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id')->withDefault(['name'=>'N/A']);
    }
}

