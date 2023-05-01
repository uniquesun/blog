@extends('layouts.app')
@section('title','文章归档')

@section('content')
    <!--文章归档-->
    <section class="pt-1 h-100" >
        <!--分类-->
        <div class="container mt-5">
            <h2 class="my-4 mx-1 article-title fw-bolder">归档</h2>

            @if(count($allCategories))
                <div class="category">
                    @foreach($allCategories as $category)
                        <a href="{{ "/category/".$category->name }}"
                           class="btn btn-sm rounded-5 px-3 me-2 mb-2 {{ $category->name == $category_name ? 'btn btn-primary':"btn-outline-primary" }}">
                            {{ $category->name }}</a>
                    @endforeach
                </div>
            @endif


            <div class="bg-white p-3 mt-2">
                @if(count($articles))
                    <ul class="ps-1">
                        @foreach($articles as $article)
                            <li class="py-2">{{ "[ ".substr($article->created_at,0,10)." ]" }}
                                <a href="{{ "/article/".$article->id }}"
                                   class="text-black ms-2">{{ $article->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="py-2">额，可能博主还在构思~，去看看别的吧！</p>
                @endif

            </div>

        </div>
    </section>
@endsection

