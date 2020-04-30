<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;

class Home extends Controller
{
    public function __construct()
    {
      view()->share('pages',Page::orderBy('order','ASC')->get());
      view()->share('categories',Category::where('active',1)->where('is_deleted',0)->orderBy('name','ASC')->get());
    }

    public function index()
    {
      $data["articles"] = Article::where('active',1)->where('is_deleted',0)->orderBy('created_at','DESC')->limit(10)->paginate(5);
      return view('front.home',$data);
    }

    public function page($slug)
    {
      $page = Page::where('slug',$slug)->first() ?? abort(403, 'Sayfa bulunamadı.');
      $data["page"] = $page;
      return view('front.page',$data);
    }

    public function singleArticle($category,$slug)
    {
      $category = Category::where('slug',$category)->where('active',1)->where('is_deleted',0)->first() ?? abort(403,'Böyle bir kategori yok.');
      $article = Article::where('slug',$slug)->where('category',$category->id)->where('active',1)->where('is_deleted',0)->first() ?? abort(403,'Böyle bir yazı yok.');
      $article->increment('hit');
      $data["article"] = $article;
      return view('front.singleArticle',$data);
    }

    public function category($slug)
    {
      $category = Category::where('slug',$slug)->where('active',1)->where('is_deleted',0)->first() ?? abort(403,'Böyle bir kategori yok.');
      $data["category"] = $category;

      $articles = Article::where('category',$category->id)->where('active',1)->where('is_deleted',0)->orderBy('created_at','DESC')->paginate(5) ?? abort(403,'Böyle bir yazı yok.');
      $data["articles"] = $articles;

      return view('front.category',$data);
    }

    public function contact()
    {
      return view('front.contact');
    }

    public function contactPost(Request $request)
    {
      $rules = [
        'name'=>'required|min:5',
        'email'=>'required|email',
        'topic'=>'required',
        'message'=>'required|min:10'
      ];
      $validate = Validator::make($request->post(),$rules);

      if ($validate->fails()) {
        $message = $validate->errors()->first('message');
        return redirect()->route('contact')->withErrors($validate)->withInput();
      }else {
        $contact = new Contact;
        $contact->name = "$request->name";
        $contact->email = "$request->email";
        $contact->topic = "$request->topic";
        $contact->message = "$request->message";
        $contact->created_at = now();
        $contact->updated_at = now();

        $contact->save();

        Mail::send([],[],
          function ($message) use($request) {
            $message->from('dumanmurat@mail.com.tr','Blog Murat');
            $message->to("dumanmurat@mail.com.tr");
            $message->setBody("Mesajı Gönderen: ".$request->name."<br>"
            ."E-posta Adresi: ".$request->email."<br>"
            ."Konu: <b>".$request->topic."</b> - ".date("d.m.Y H:i:s",strtotime(now()))."<br><br>"
            ."Mesaj: ".$request->message."<br>","text/html");
            $message->subject($request->name." blog sitesinden bir mesaj bıraktı");
        });

        return redirect()->route('contact')->with('success',"Mesajını aldım");
      }
    }
}
