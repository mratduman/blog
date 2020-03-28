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
      //print_r(Category::all());
      $data["articles"] = Article::orderBy('created_at','DESC')->get();
      $data["categories"] = Category::orderBy('name','ASC')->get();
      return view('front.home',$data);
    }
}
