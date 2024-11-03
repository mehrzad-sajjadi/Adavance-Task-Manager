<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\router;
use App\Http\Middleware\learning;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user_id=Auth::id();
    $category = Category::where("user_id",$user_id)->pluck('id')->toArray();
    $post = Post::whereIn("category_id",$category)->pluck('id')->toArray();
    $user = User::all();
    return Inertia::render('Dashboard',compact('category','user','post'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix("categories")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[CategoryController::class,'index'])->name("category.index");
    Route::delete("/{category}/delete",[CategoryController::class,'destroy'])->name("category.destroy");
    Route::get("/{category}/show",[CategoryController::class,'show'])->name("category.show");
    Route::get("/{category}/edit",[CategoryController::class,'edit'])->name("category.edit");
    Route::put("/{category}/update",[CategoryController::class,'update'])->name("category.store");
    Route::get("/create",[CategoryController::class,'create'])->name("category.create");
    Route::post("/",[CategoryController::class,'store'])->name("category.store");
});
Route::post("/axios",[CategoryController::class,'axios' ])->name("ax");

Route::prefix("posts")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[PostController::class,'index'])->name("post.index");
    Route::delete("/{post}/delete",[PostController::class,'destroy'])->name("post.destroy");
    Route::get("/{post}/show",[PostController::class,'show'])->name("post.show");
    Route::get("/{post}/edit",[PostController::class,'edit'])->name("post.edit");
    Route::put("/{post}/update",[PostController::class,'update'])->name("post.update");
    Route::get("/create",[PostController::class,'create'])->name("post.create");
    Route::post("/",[PostController::class,'store'])->name("post.store");
});

Route::prefix("user")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[ProfileController::class,'edit'])->name("user_index");
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
