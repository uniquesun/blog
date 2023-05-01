@extends('layouts.app')
@section('title','文章详情')

@section('content')
    <!--文章详情-->
    <section class="mh-100 h-100 mt-3">
        <div class="container py-2 text-center bg-white">
            <div class="article-title mx-auto " style="max-width: 860px">
                <div class="py-2 fw-bold text-secondary ">
                    <span class="fs-7 me-1">{{ $article->subtitle }}</span>
                    <span class="fs-7">{{ $article->created_at }}</span>
                </div>
                <div class="fs-2 fw-bolder mt-2 mx-auto">{{ $article->title }}</div>
                @if(count($article->categories))
                    <div class="text-center mt-4">
                        @foreach($article->categories as $category)
                            <a href="{{ "/category/".$category->name }}"
                               class="btn btn-primary btn-sm rounded-5 px-3 me-2">{{ $category->name }}</a>
                        @endforeach
                    </div>
                @endif
                <hr>
            </div>

            <div class="title-content mx-100 text-center">
                {{ $article->content }}
            </div>

        </div>
    </section>
@endsection

