<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::orderBy('created_at','DESC')->get();
    return view('back.categories.index',compact('categories'));
  }

  public function cetagoryTable()
  {
    $categories = Category::orderBy('created_at','DESC')->get();
    return view('back.categories.indexCategoryTable',compact('categories'));
  }

  public function create(Request $request)
  {
    $request->validate([
      'image'=>'required|image|mimes:jpeg,png,jpg|max:1025'
    ]);
    $isExits = Category::whereSlug(Str::slug($request->name))->first();
    if ($isExits) {
      toastr()->error($request->name . " adında bir kategori zaten var.");
      return redirect()->route('admin.category.index');
    }
    $category = new Category;
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->slogan = $request->slogan;
    if ($request->hasFile('image')) {
      $imageName = Str::slug($request->name).'.'.$request->image->getClientOriginalExtension();
      $request->image->move(public_path('front/img'),$imageName);
      $category->image = $imageName;
    }
    $category->save();
    toastr()->success("Eklendi.");
    return redirect()->route('admin.category.index');
  }

  public function update(Request $request)
  {
    $category = Category::findOrFail($request->id);
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->active = $request->active;
    $category->updated_at = now();
    $category->save();

    if ($request->active==0) {
      Article::where('category', '=', $request->id)->update(array('active' => 0));
    }

    toastr()->success('Başarılı','Güncellendi');
    return "success";
  }

  public function imageEdit(Request $request)
  {
    $validate = $request->validate([
      'newImage'=>'required|image|mimes:jpeg,png,jpg|max:1025'
    ]);
    $category = Category::findOrFail($request->imageEditCategoryId);
    $imageName = $category->image;
    if ($imageName!="") {
      @unlink('front/img/'.$category->image);
      $request->newImage->move(public_path('front/img'),$imageName);
    }else {
      $imageName = $category->slug.".".$request->newImage->getClientOriginalExtension();
      $request->newImage->move(public_path('front/img'),$imageName);
      $category->image = $imageName;
      $category->save();
    }
    toastr()->success('Başarılı!',$category->name.' resmi değiştirildi.');
    return redirect()->route('admin.category.index');
  }

}
