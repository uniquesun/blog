<?php

namespace App\Controller\web;

use App\Controller\AbstractController;

use App\Model\Article;
use App\Model\Category;
use App\Service\ArticleService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\View\RenderInterface;
use function Hyperf\ViewEngine\view;

#[Controller]
class HomeController extends AbstractController
{
    protected int $recommend_articles_limit = 9;
    protected int $random_articles_limit = 6;

    #[RequestMapping(path: '/', methods: 'get')]
    public function index(ArticleService $articleService)
    {
        $recommend_articles = $articleService->recommend($this->recommend_articles_limit);
        $random_articles = $articleService->random($this->random_articles_limit);
        return view('home', compact('recommend_articles', 'random_articles'));
    }

    #[RequestMapping(path: '/about', methods: 'get')]
    public function about()
    {
        return view('about');
    }


}