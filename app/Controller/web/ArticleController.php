<?php

namespace App\Controller\web;

use App\Controller\AbstractController;

use App\Model\Article;
use App\Model\Category;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use function Hyperf\ViewEngine\view;

#[Controller]
class ArticleController extends AbstractController
{
    #[RequestMapping(path: '/article/{id}', methods: 'get')]
    public function show(int $id)
    {
        $article = Article::query(true)->with(['tags', 'categories'])->where('id', $id)->first();
        return view('article', compact('article'));
    }

    #[RequestMapping(path: '/category/[{name}]', methods: 'get')]
    public function index(RequestInterface $request)
    {
        $category_name = $request->route('name', '');

        $allCategories = Category::query(true)->orderBy('level')->get();

        $articles = Article::query(true)
            ->when($category_name, function ($query, $category_name) {
                $query->whereHas('categories', function ($query) use ($category_name) {
                    $query->where('name', $category_name);
                });
            })
            ->orderBy('id', 'desc')->paginate(5);

        return view('article_lists', compact(
            'articles',
            'allCategories',
            'category_name'
        ));
    }

}