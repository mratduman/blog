<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;

class Dashboard extends Controller
{
    public function index()
    {
      $articleCount = Article::all()->count();
      $articleHit = Article::sum("hit");
      $categoryCount = Category::all()->count();
      $bestArticles = Article::orderBy("hit","DESC")->limit(5)->get();
      $worstArticles = Article::orderBy("hit","ASC")->limit(5);
      $contactCount = Contact::all()->count();
      return view('back.dashboard',compact('articleCount','articleHit','categoryCount','bestArticles','worstArticles','contactCount'));
    }
}
