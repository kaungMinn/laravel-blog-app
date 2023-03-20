<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index(){

        $articles = Article::latest()->paginate(5);
       

        return view('articles.index',[
            'articles' => $articles,
          
        ]);
    }

    public function detail($id){
        $article = Article::find($id);
        return view('articles.detail',[
            'article' => $article
        ]);
    }

    public function delete($id){
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles')->with('info', 'An Article Deleted');
    }

    public function edit($id){
        $article = Article::find($id);
        $categories = Category::all();
        return view('articles.edit',[
            'categories' => $categories,
            'article' => $article
        ]);
    }

    public function update(Request $req,$id){
        $article = Article::find($id);
        $article->title = $req->title;
        $article->body = $req->body;
        $article->category_id = $req->category_id;
        $article->save();
        
        return redirect("articles/detail/$article->id")->with('info', 'An Article Edited');
    }

    public function create(){

        $categories = Category::all();
        
        return view('articles/create',[
            'categories' => $categories,
        ]);
    }


    public function upload(Request $req){
        $validator = validator(request()->all(),[
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);


        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = $req->title;
        $article->body = $req->body;
        $article->category_id = $req->category_id;
        $article->save();

        return redirect('/articles')->with('info', 'An Article Added');
    }
}
 