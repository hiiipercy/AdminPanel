<?php
namespace App\Repositories;

use App\Models\Tag;

class Tag1 implements TestInterface{
    public function all(){
        return Tag::get();
    }

    public function show($id){
        return Tag::find($id);
    }

    public function get($id){
        return Tag::find($id);
    }

    public function store(array $data){
        return Tag::create($data);
    }

    public function update($id, array $data){
        return Tag::find($id)->update($data);
    }

    public function delete($id){
        return Tag::destroy($id);
    }
}
