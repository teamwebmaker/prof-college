<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.articles.index',[
            'articles' =>  Article::orderBy('id', 'DESC')->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/articles';

            $image->move(public_path($uploadPath), $imageName);

        } else {
            $imageName = null;
        }

        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        $description = ["ka" => $data['description_ka'], "en" => $data['description_en']];
        $storeData = [
            'title' => $title,
            'description' => $description,
            'image' => $imageName,
            'category_id' => $data['category_id'],
            'uuid' =>  Str::uuid()->toString()
        ];

        if ($data['embed']) {
            Article::create([...$storeData, 'embed' => $data['embed']]);

        } else {
            Article::create($storeData);

        }

        return redirect()->route('articles.index', ['language' => app() -> getLocale()])->with('success', 'სტატია წარმატებით დაემატა');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $language, Article $article)
    {
        $article->load('docs');

        return view('pages.view-more', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $language, Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request,string $language,  Article $article)
    {
        $data = $request->validated();

        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        $description = ["ka" => $data['description_ka'], "en" => $data['description_en']];
        $storeData = [
            'title' => $title,
            'description' => $description,
            'category_id' => $data['category_id'],
            'uuid' =>  Str::uuid()->toString()
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/articles';
            $image->move(public_path($uploadPath), $imageName);
            $storeData = [...$storeData, 'image' => $imageName];
        }

        if ($data['embed']) {
           $storeData = [...$storeData, 'embed' => $data['embed']];
        }
        $article -> update($storeData);
        return redirect() -> back() -> with('success', 'article added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Article $article)
    {
        $article -> delete();
        return redirect() -> route('articles.index', ['language' => app() -> getLocale()]) -> with('success', 'სიახლე წარმატებით წაიშალა.');
    }
}
