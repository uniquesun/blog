<?php

namespace App\Service;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use Carbon\Carbon;
use Hyperf\HttpServer\Contract\RequestInterface;

class ArticleService
{
    protected ArticleRepository $articleRepository;
    protected TagRepository $tagRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository, CategoryRepository $categoryRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function adminPaginate(RequestInterface $request)
    {
        $page = $request->input('page', 1);
        $page_size = $request->input('page_size', 20);
        $title = $request->input('title');
        $order = $request->input('order');
        $sort = $request->input('sort');
        $category_name = $request->route('name', '');

        return $this->articleRepository->getAdminPaginate(compact(
            'page', 'page_size', 'title', 'order', 'sort', 'category_name'
        ));

    }

    public function webPaginate(RequestInterface $request)
    {
        $category_name = $request->route('name', '');
        $page = $request->input('page', 1);
        $page_size = $request->input('page_size', 20);

        return $this->articleRepository->getWebPaginate(compact(
            'page', 'page_size', 'category_name'
        ));
    }

    public function show($id)
    {
        return $this->articleRepository->findWithRelationship($id);
    }


    public function store(RequestInterface $request)
    {
        // 保存博客
        $article = $this->articleRepository->store([
            'subtitle' => $request->input('subtitle'),
            'title' => $request->input('title'),
            'slug' => strtolower(str_replace(' ', '-', $request->input('slug'))),
            'image' => $request->input('image'),
            'content' => $request->input('content'),
            'is_published' => $request->input('is_published', false),
            'is_recommend' => $request->input('is_recommend', false)
        ]);
        // 保存标签
        if ($tags = $request->input('tags')) {
            $exist_tags = $this->tagRepository->findExistName($tags)->toArray();
            // 添加不存在的标签
            $add_tags = array_diff($tags, array_column($exist_tags, 'name'));
            if ($add_tags) {
                list($data, $now) = [[], Carbon::now()];
                foreach ($add_tags as $tag) {
                    $data[] = ['name' => $tag, 'created_at' => $now, 'updated_at' => $now];
                }
                $this->tagRepository->insert($data);
            }
            // 查询出标签，并关联
            $exist_tags = $this->tagRepository->findExistName($tags)->toArray();
            $article->tags()->attach(array_column($exist_tags, 'id'));
        }
        // 保存分类
        if ($categories = $request->input('categories')) {
            $article->categories()->attach($categories);
        }
        return;
    }

    public function update($id, RequestInterface $request)
    {
        $article = $this->articleRepository->findWithRelationship($id);
        // 更新博客
        $this->articleRepository->update($id, [
            'subtitle' => $request->input('subtitle', $article->subtitle),
            'title' => $request->input('title', $article->title),
            'slug' => strtolower(str_replace(' ', '-', $request->input('slug', $article->title))),
            'image' => $request->input('image', $article->image),
            'content' => $request->input('content', $article->content),
            'is_published' => $request->input('is_published', $article->is_published),
            'is_recommend' => $request->input('is_recommend', $article->is_recommend)
        ]);
        // 更新标签
        $tag_ids = array_column($article->tags->toArray(), 'id');
        if ($tags = $request->input('tags')) {
            $exist_tags = $this->tagRepository->findExistName($tags)->toArray();
            // 添加不存在的标签
            $add_tags = array_diff($tags, array_column($exist_tags, 'name'));
            if ($add_tags) {
                list($data, $now) = [[], Carbon::now()];
                foreach ($add_tags as $tag) {
                    $data[] = ['name' => $tag, 'created_at' => $now, 'updated_at' => $now];
                }
                $this->tagRepository->insert($data);
            }
            // 查询出标签，并关联
            $new_tag_ids = array_column($this->tagRepository->findExistName($tags)->toArray(), 'id');
            if ($add_attach = array_diff($new_tag_ids, $tag_ids)) {
                $article->tags()->attach($add_attach);
            }
            if ($sub_attach = array_diff($tag_ids, $new_tag_ids)) {
                $article->tags()->detach($sub_attach);
            }
        }
        // 更新分类
        $category_ids = array_column($article->categories->toArray(), 'id');
        if ($categories = $request->input('categories')) {
            if ($add_attach = array_diff($categories, $category_ids)) {
                $article->categories()->attach($add_attach);
            }
            if ($sub_attach = array_diff($category_ids, $categories)) {
                $article->categories()->detach($sub_attach);
            }
        }
        return;
    }

    public function destroy($id)
    {
        return $this->articleRepository->destroy($id);
    }

    public function random($limit)
    {
        return $this->articleRepository->random($limit);
    }

    public function recommend($limit)
    {
        return $this->articleRepository->recommend($limit);
    }


}