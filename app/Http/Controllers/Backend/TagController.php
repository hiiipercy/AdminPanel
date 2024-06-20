<?php
namespace App\Http\Controllers\Backend;


use App\Repositories\TestInterface;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{   
    protected $tag;
    public function __construct(TestInterface $tag)
    {
        return $this->tag = $tag;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $tag = Tag::orderBy('order_by')->get();
        // $tag = $this->tag->all();
        return view('backend.modules.tag.index',compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('backend.modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
      
        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|max:255|unique:tags',
            'order_by'=>'required|numeric',
            'status'=>'required'
        ]);

        $tag_data = $request->all();
        $tag_data['slug'] = Str::slug($request->input('slug')); //input will take without spacing

        Tag::create($tag_data);
        // $this->tag->store($tag_data);
        session()->flash('cls','success');
        session()->flash('msg','Tag created successfully');
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {   $this->tag->show($tag);
        return view('backend.modules.tag.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $tag = Tag::find($tag->id);
        // $tag = $this->tag->get($tag->id);
        return view('backend.modules.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {  
        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|max:255|unique:tags,slug,'.$tag->id,
            'order_by'=>'required|numeric',
            'status'=>'required'
        ]);

        $tag_data = $request->all();
        $tag_data['slug'] = Str::slug($request->input('slug')); //input will take without spacing

        Tag::find($tag->id)->update($tag_data);
        // $this->tag->update($tag->id, $tag_data);

        session()->flash('cls','success');
        session()->flash('msg','tag updated successfully');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {
        // $tag->delete();
        // $this->tag->delete($tag->id);
        Tag::find($tag->id)->delete($tag->id);

        session()->flash('cls','error');
        session()->flash('msg','tag deleted successfully');
        return redirect()->route('tag.index');
    }
}
