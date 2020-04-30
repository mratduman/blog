<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $articles = Article::where("is_deleted",0)->orderBy('created_at','DESC')->get();
      return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'title'=>'min:3',
        'image'=>'required|image|mimes:jpeg,png,jpg|max:1025'
      ]);
      $article = new Article;
      $article->title = $request->title;
      $article->category = $request->category;
      $article->content = $request->content;
      $article->slug = Str::slug($request->title);
      $article->created_at = now();
      $article->updated_at = now();

      if ($request->hasFile('image')) {
        $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'),$imageName);
        $article->image = 'uploads/'.$imageName;
      }
      $article->save();
      toastr()->success('Başarılı','Yazı eklendi');
      return redirect()->route('admin.articles.index'); // ->with('success',"Mesajını aldım")
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $article = Article::findOrFail($id);
      $category = Category::find($article->category);
      $categories = Category::all();
      return view('back.articles.edit',compact('categories','article','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'title'=>'min:3',
        'image'=>'image|mimes:jpeg,png,jpg|max:1025'
      ]);
      $article = Article::findOrFail($id);
      if ($request->active==1) {
        $category = Category::findOrFail($request->category);
        if ($category->active==0) {
          toastr()->error('','Yazının seçilen kategorisi pasif konumda olduğundan yazı aktif hale getirilemez.');
          return redirect()->route('admin.articles.edit',$article->id);
        }
      }
      $article->title = $request->title;
      $article->category = $request->category;
      $article->content = $request->content;
      $article->slug = Str::slug($request->title);
      $article->active = $request->active;
      $article->updated_at = now();

      if ($request->hasFile('image')) {
        $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'),$imageName);
        $article->image = 'uploads/'.$imageName;
      }
      $article->save();
      toastr()->success('Başarılı','Yazı güncellendi');
      return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
      $article = Article::findOrFail($request->id);
      $article->is_deleted = 1;
      $article->save();
      return "Silindi";
    }

    public function trashed()
    {
      $articles = Article::where("is_deleted",1)->orderBy('created_at','DESC')->get();
      return view('back.articles.trashed',compact('articles'));
    }

    public function publish(Request $request)
    {
      $article = Article::findOrFail($request->id);
      $article->is_deleted = 0;
      $article->save();
      return "Yayinlandi";
    }
}
