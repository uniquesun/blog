<?php

namespace App\Service;


use App\Repository\TagRepository;
use Hyperf\HttpServer\Contract\RequestInterface;

class TagService
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function adminPaginate(RequestInterface $request)
    {
        $page = $request->input('page', 1);
        $page_size = $request->input('page_size', 20);
        $name = $request->input('name');
        $order = $request->input('order');
        $sort = $request->input('sort');

        return $this->tagRepository->getAdminPaginate(compact(
            'page', 'page_size', 'name', 'order', 'sort',
        ));

    }

    public function destroy($id)
    {
        return $this->tagRepository->destroy($id);
    }

}