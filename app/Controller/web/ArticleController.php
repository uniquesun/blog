<?php

namespace App\Controller\web;

use App\Controller\AbstractController;

use App\Model\Article;
use App\Model\Category;
use App\Service\ArticleService;
use App\Service\CategoryService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use function Hyperf\ViewEngine\view;

#[Controller]
class ArticleController extends AbstractController
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    #[RequestMapping(path: '/article/{id}', methods: 'get')]
    public function show(int $id)
    {
        $article = $this->articleService->show($id);
        return view('article', compact('article'));
    }

    #[RequestMapping(path: '/category/[{name}]', methods: 'get')]
    public function index(RequestInterface $request, CategoryService $categoryService)
    {
        $category_name = $request->route('name', '');
        $allCategories = $categoryService->all();
        $articles = $this->articleService->webPaginate($request);

        return view('article_lists', compact(
            'articles',
            'allCategories',
            'category_name'
        ));
    }

}