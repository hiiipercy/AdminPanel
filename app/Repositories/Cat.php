<?php
namespace App\Repositories;

use App\Models\Category;

class Cat implements TestInterface{

    public function all()
    {
        return  Category::orderBy('order_by')->get();    
    }

    public function get($id)
    {
        return Category::find($id);   
    }

    public function store(array $data)
    {
        return Category::create($data);   
    }

    public function show($id){
        return Category::find($id);
    }

    public function update($id, array $data)
    {
        return Category::find($id)->update($data);   
    }

    public function delete($id)
    {
        return Category::destroy($id);   
    }
}