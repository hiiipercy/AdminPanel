<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\TestInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class SubCategoryController extends Controller
{
    protected $sub;
    public function __construct(TestInterface $sub)
    {
        $this->sub = $sub;
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {   
        $subcategory= SubCategory::with('category')->orderBy('order_by')->get();
        // $subcategory= $this->sub->all();
        return view('backend.modules.sub_category.index',compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {   
        $category = Category::pluck('name','id');
        return view('backend.modules.sub_category.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|max:255|unique:sub_categories',
            'category_id'=>'required|max:255',
            'order_by'=>'required|numeric',
            'status'=>'required'
        ]);

        $sub_category_data = $request->all();
        $sub_category_data['slug'] = Str::slug($request->input('slug')); //input will take without spacing

        SubCategory::create($sub_category_data);
        session()->flash('cls','success');
        session()->flash('msg','sub_category created successfully');
        return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {   
        $subCategory->load('category');
        //   $subCategory = $this->sub->show($id);
        return view('backend.modules.sub_category.show',compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {   
        $category = Category::pluck('name','id');
        // $category = $this->sub->get();
        return view('backend.modules.sub_category.edit',compact('subCategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|max:255|unique:sub_categories,slug,'.$subCategory->id,
            'category_id'=>'required|max:255',
            'order_by'=>'required|numeric',
            'status'=>'required'
        ]);

        $sub_category_data = $request->all();
        $sub_category_data['slug'] = Str::slug($request->input('slug')); //input will take without spacing

        // $this->sub->store($sub_category_data);
        SubCategory::find($subCategory->id)->update($sub_category_data);
        session()->flash('cls','success');
        session()->flash('msg','sub_category updated successfully');
        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        // $subCategory->delete();
        SubCategory::find($subCategory->id)->delete($subCategory->id);

        session()->flash('cls','error');
        session()->flash('msg','Sub category deleted successfully');
        return redirect()->route('sub_category.index');
    }

    public function getSubCategoryByCategoryId(int $id){
        $sub_category = SubCategory::select('id','name')->where('status', 1)->where('category_id', $id)->get();
        return response()->json($sub_category);
    }
}
