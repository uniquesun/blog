<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Request\ArticleRequest;
use App\Resource\ArticleResource;
use App\Service\ArticleService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
#[Middleware(RefreshTokenMiddleware::class)]
class ArticleController extends AbstractController
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    #[RequestMapping(path: '/admin/v1/article', methods: 'get')]
    public function index(RequestInterface $request)
    {
        $articles = $this->articleService->adminPaginate($request);
        return $this->resource(ArticleResource::collection($articles));
    }

    #[RequestMapping(path: '/admin/v1/article/{id}', methods: 'get')]
    public function show(int $id)
    {
        $article = $this->articleService->show($id);
        return $this->resource(new ArticleResource($article));
    }

    #[RequestMapping(path: '/admin/v1/article', methods: 'post')]
    public function store(ArticleRequest $request)
    {
        $this->articleService->store($request);
        return $this->success();
    }

    #[RequestMapping(path: '/admin/v1/article/{id}', methods: 'put')]
    public function update(int $id, RequestInterface $request)
    {
        $this->articleService->update($id, $request);
        return $this->success();
    }

    #[RequestMapping(path: '/admin/v1/article/{id}', methods: 'delete')]
    public function destroy(int $id)
    {
        $this->articleService->destroy($id);
        return $this->success();
    }

}