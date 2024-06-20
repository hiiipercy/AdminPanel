<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageUploadController;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $posts = Post::with('category','subCategory','user','tag')->latest()->paginate(20);
        return view('backend.modules.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::where('status', 1)->pluck('name','id');
        $tag= Tag::where('status', 1)->select('name','id')->get();
        return view('backend.modules.post.create',compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store(PostCreateRequest $request)
    {   
        $post_data = $request->except(['tag_ids', 'image', 'slug']); //except means remove those ids
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = Str::slug($request->input('slug'));
            $height= 400;
            $width= 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'image/post/original/';
            $thumb_path = 'image/post/thumb/';

            $post_data['image'] = ImageUploadController::imageUpload($name, $height, $width, $path, $file);
            ImageUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post = Post::create($post_data);
        $post->tag()->attach($request->input('tag_ids'));

        session()->flash('cls', 'success');
        session()->flash('msg', 'Post created successfully');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $posts = Post::find($post->id);
        return view('backend.modules.post.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $category = Category::where('status', 1)->pluck('name','id');
        $tag= Tag::where('status', 1)->select('name','id')->get();
        // $select_tags= DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id')->toArray();
        $post->load('tag');
        $select_tags = $post->tag->pluck('id')->toArray();
        return view('backend.modules.post.edit', compact('post','category','tag','select_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {


        $post_data = $request->except(['tag_ids', 'image', 'slug']); //except means remove those ids
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = Str::slug($request->input('slug'));
            $height= 400;
            $width= 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'image/post/original/';
            $thumb_path = 'image/post/thumb/';

            ImageUploadController::imageUnlink($path, $post->image); //to remove image from the database
            ImageUploadController::imageUnlink($thumb_path, $post->image); //to remove image from the database

            $post_data['image'] = ImageUploadController::imageUpload($name, $height, $width, $path, $file);
            ImageUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post->update($post_data);
        $post->tag()->sync($request->input('tag_ids'));

        session()->flash('cls', 'success');
        session()->flash('msg', 'Post upadated successfully');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Post::find($post->id)->delete($post->id);
        $path = 'image/post/original/';
        $thumb_path = 'image/post/thumb/';
        ImageUploadController::imageUnlink($path, $post->image); //to remove image from the database
        ImageUploadController::imageUnlink($thumb_path, $post->image); //to remove image from the database

        session()->flash('cls','error');
        session()->flash('msg','Post deleted successfully');
        return redirect()->route('post.index');
    }
}
