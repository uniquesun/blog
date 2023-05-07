<?php

namespace App\Controller\web;

use App\Controller\AbstractController;

use App\Model\Article;
use App\Model\Category;
use App\Service\ArticleService;
use App\Service\CategoryService;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Paginator\Paginator;
use Parsedown;
use ParsedownExtra;
use function _PHPStan_b8e553790\RingCentral\Psr7\str;
use function Hyperf\ViewEngine\view;

#[Controller]
class ArticleController extends AbstractController
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    #[RequestMapping(path: '/article/{slug}', methods: 'get')]
    public function show(string $slug)
    {
        $article = $this->articleService->show($slug);
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
            'category_name',
        ));
    }

}