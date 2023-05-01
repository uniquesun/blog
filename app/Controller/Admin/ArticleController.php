<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\Article;
use App\Model\Tag;
use App\Request\ArticleRequest;
use App\Resource\ArticleResource;
use Carbon\Carbon;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
#[Middleware(RefreshTokenMiddleware::class)]
class ArticleController extends AbstractController
{
    #[RequestMapping(path: '/admin/v1/article', methods: 'get')]
    public function index(RequestInterface $request)
    {
        $page = $request->input('page', 1);
        $page_size = $request->input('page_size', 20);
        $title = $request->input('title');
        $order = $request->input('order');
        $sort = $request->input('sort');

        $articles = Article::query()
            ->when($title, function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            })
            ->with(['tags', 'categories'])
            ->when($order & $sort, function ($query) use ($order, $sort) {
                $query->orderby($order, $sort);
            })
            ->paginate($page_size, ['*'], 'page', $page);
        return $this->resource(ArticleResource::collection($articles));
    }

    #[RequestMapping(path: '/admin/v1/article/{id}', methods: 'get')]
    public function show(int $id, RequestInterface $request)
    {
        $article = Article::query()->find($id);
        $article->load(['tags', 'categories']);
        return $this->resource(new ArticleResource($article));
    }

    #[RequestMapping(path: '/admin/v1/article', methods: 'post')]
    public function store(ArticleRequest $request)
    {
        $article = Article::create([
            'subtitle' => $request->input('subtitle'),
            'title' => $request->input('title'),
            // todo 优化为翻译
            'slug' => $request->input('slug'),
            'image' => $request->input('image'),
            'content' => $request->input('content'),
        ]);
        $tags = $request->input('tags');
        if ($tags) {
            // todo 待优化
            $exits_tags = Tag::query()->whereIn('name', $tags)->pluck('name')->toArray();
            $add_tags = array_diff($tags, $exits_tags);
            $data = [];
            $now = Carbon::now();
            foreach ($add_tags as $tag) {
                $data[] = [
                    'name' => $tag,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
            Tag::insert($data);
            $ids = Tag::query()->whereIn('name', $tags)->pluck('id')->toArray();
            $article->tags()->attach($ids);
        }

        $categories = $request->input('categories');
        if ($categories) {
            $article->categories()->attach($categories);
        }
        return $this->success();
    }

    #[RequestMapping(path: '/admin/v1/article/{id}', methods: 'put')]
    public function update(int $id, RequestInterface $request)
    {
//        $article = Article::query()->where('id', $id)->update(
//            $request->only(['subtitle', 'title', 'slug', 'image', 'content'])
//        );
    }

    #[RequestMapping(path: '/admin/v1/article/{id}', methods: 'delete')]
    public function destroy(int $id)
    {
        Article::query()->where('id', $id)->delete();
        return $this->success();
    }

}