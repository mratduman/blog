<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class Home extends Controller
{
    public function index()
    {
      $data["categories"] = Category::orderBy('name','ASC')->get();
      $data["articles"] = Article::orderBy('created_at','DESC')->get();

      return view('front.home',$data);
    }

    public function singleArticle($category,$slug)
    {
      $category = Category::where('slug',$category)->first() ?? abort(403,'Böyle bir kategori yok.');
      $article = Article::where('slug',$slug)->where('category',$category->id)->first() ?? abort(403,'Böyle bir yazı yok.');
      $article->increment('hit');
      $data["article"] = $article;
      $data["categories"] = Category::orderBy('name','ASC')->get();
      return view('front.singleArticle',$data);
    }
}
