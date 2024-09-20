<?php

namespace App\Http\Controllers;

use App\Http\Requests\postRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
    $user_id = Auth::id();
    $category_ids = Category::where("user_id",$user_id)->pluck('id');

    $posts = Post::whereIn("category_id",$category_ids)->paginate(4);

    return Inertia::render("posts/index_post",compact("posts"));
}



/**
 * Show the form for creating a new resource.
 */
public function create()
{
    $user_id = Auth::id();
    $categories = Category::where("user_id",$user_id)->get()->toArray();

    return Inertia::render('posts/create_post',compact("categories"));
}

/**
 * Store a newly created resource in storage.
 */

 public function store(postRequest $postRequest)
{
    $post=new Post();
    $post->name = $postRequest->name;
    $post->content = $postRequest->content;
    $post->category_id = $postRequest->category_id;
    
    $check=Post::where("name",$post->name)->where("category_id",$post->category_id )->first();
    if($check){
        return redirect()->route("post_create")->with("error","پست مورد نظر قبلا با همین نام و نوع دسته بندی ایجاد شده ");
    }else{
        $post->save();
        return redirect()->route("post_index")->with("message","پست مورد نظر ایجاد شد");
    }
}


/**
 * Display the specified resource.
 */
public function show($id)
{   
    $post = Post::findOrFail($id);
    $user_post = $post->category->user->name;
    $category_post = $post->category->name;
    return Inertia::render("posts/show_post",compact("user_post","category_post","post"));
}

/**
 * Show the form for editing the specified resource.
 */
public function edit(Post $post)
{

    $user_id = Auth::id();
    $categories = Category::where("user_id",$user_id)->get()->toArray();
    return Inertia::render("posts/edit_post",compact("categories","post"));
}

/**
 * Update the specified resource in storage.
 */

public function update(postRequest $postRequest,$id)
{

    $post=Post::findOrFail($id);
    $post->name = $postRequest->name;
    $post->content = $postRequest->content;
    $post->category_id = $postRequest->category_id;

    $check = $post->where("name",$post->name)->where("category_id",$post->category_id)->first();

    if($check){
        return redirect()->route("post_edit",$id)->with("error","پست مورد نظر قبلا با همین نام و نوع دسته بندی ایجاد شده ");
    }else{
        $post->save();
        return redirect()->route("post_index")->with("message","پست مورد نظر ویرایش شد");
    }


}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Post $post)
{
    $post->delete();
    return "Finish";
    // return redirect()->route("post_index")->with("message","پست مورد نظر حذف شد");;
}

}