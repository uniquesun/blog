<?php

namespace App\Controller\web;

use App\Controller\AbstractController;

use App\Model\Article;
use App\Model\Category;
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
    public function index()
    {
        $recommend_articles = Article::query(true)
            ->orderBy('is_recommend', 'desc')
            ->orderBy('id')
            ->limit($this->recommend_articles_limit)->get();
        $random_articles = Article::query()
            ->orderByRaw("RAND()")
            ->limit($this->random_articles_limit)
            ->get();
        return view('home', compact('recommend_articles', 'random_articles'));
    }

    #[RequestMapping(path: '/about', methods: 'get')]
    public function about()
    {
        return view('about');
    }


}