<?php
namespace App\Repositories;


use App\Models\SubCategory;

class Sub implements TestInterface{

    public function all(){
        return SubCategory::with('category')->orderBy('order_by')->get();
    }

    public function get($id){
        return SubCategory::find($id);
    }
    
    public function show($id){
        return SubCategory::find($id);
    }

    public function store(array $data){
        return SubCategory::create($data);
    }

    public function update($id, array $data){
        return SubCategory::find($id)->update($data);
    }

    public function delete($id){
        return SubCategory::destroy($id);
    }
}