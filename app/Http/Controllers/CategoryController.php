<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryStoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CategoryController extends Controller
{


public function index(){
    dd("askldjl");

    $categories2 = Category::all();
    $categories=[];
    foreach($categories2 as $category){
        array_push($categories,[
            "id"=>$category->id,
            "name"=>$category->name
        ]);
    }

    return Inertia::render("posts/categories/index_category",compact("categories"));
}
public function axios(Request $request){
    dd("askldjl");
    $categories  = Post::where("category_id",$request->id)->count();
    return $categories;
}





public function create()
{
    $user_id=Auth::id();
    return Inertia::render('posts/categories/create_category',compact('user_id'));
}


public function store(categoryStoreRequest $categoryStoreRequest)
{
    $category=new Category();
    $category->name = $categoryStoreRequest->name;
    $category->user_id = $categoryStoreRequest->user_id;
    $check = Category::where("name",$category->name)->where("user_id",$category->user_id )->first();
    if($check){
        return redirect()->route("category.create")->with("error","شما این دسته بندی را قبلا ایجاد کرده اید");
    }else{
        $category->save();
        return redirect()->route("category.index")->with("message","دسته بندی با موفقیت ایجاد شد");    
    }

}

public function show($id)
{

    $user = User::find(Auth::id());
    $category=Category::find($id);
    
    if(!$user->can("view",$category)){
        abort(403);
    }
    $posts=$category->Post->toArray();
    $user_name = $category->user->name;
    return Inertia::render("posts/categories/new",compact("posts","category","user_name"));


}


public function edit($id)
{
    
    $user = User::find(Auth::id());

    $category = Category::findOrFail($id);

    
    return Inertia::render("posts/categories/edit_category",compact('category'));
}



public function update(categoryStoreRequest $categoryStoreRequest,$id)
{
    $user = User::find(Auth::id());

    $category=Category::findOrFail($id);
    if(!$user->can("update",$category)){
        abort(403);
    }


    $category->name=$categoryStoreRequest->name;
    $check = $category->where("name",$category->name)->first();
    if($check){
        return redirect()->route("category.edit",$id)->with("error","شما این دسته بندی را قبلا ایجاد کرده اید");
    }else{
        $category->save();
        return redirect()->route("category.index")->with("message","دسته بندی مورد نظر ویرایش شد");    
    }
}


public function destroy(Category $category)
{
    $category->delete();
    return redirect()->route("category.index")->with("message","دسته بندی مورد نظر حذف شد");;
}



}





