<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Repositories\TestInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $test;
    public function __construct(TestInterface $test)
    {
        $this->test = $test;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $category = $this->test->all();
        return view('backend.modules.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'required|max:255|unique:categories',
            'order_by' => 'required|numeric',
            'status' => 'required'
        ]);

        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug')); //input will take without spacing

        $this->test->store($category_data);
        session()->flash('cls', 'success');
        session()->flash('msg', 'Category created successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($category)
    {
        $category = $this->test->get($category);
        return view('backend.modules.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category)
    {   
        $category= $this->test->get($category);
        return view('backend.modules.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, Request $request)
    {   

        $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'required|max:255|unique:categories,slug,'.$category->id, // here "$category->id" is used for handling error, if user update the same data, there will be an error.
            'order_by' => 'required|numeric',
            'status' => 'required'
        ]);

        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug')); //input will take without spacing
        $this->test->update($category->id, $category_data);

        session()->flash('cls', 'success');
        session()->flash('msg', 'Category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->test->delete($category->id);

        session()->flash('cls', 'error');
        session()->flash('msg', 'Category deleted successfully');
        return redirect()->route('category.index');
    }
}
