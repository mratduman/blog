<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class Home extends Controller
{
    public function index()
    {
      //print_r(Category::all());
      $data["categories"] = Category::inRandomOrder()->get();
      return view('front.home',$data);
    }
}
