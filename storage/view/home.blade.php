@extends('layouts.app')
@section('title','主页')

@section('content')
    <!--推荐文章-->
    <section class="pt-1">
        <div class="container">
            <h2 class="my-4 mx-1 article-title fw-bolder">推荐文章</h2>
            @foreach($recommend_articles as $index =>  $recommend_article)
                <div class="row mx-1 justify-content-center">
                    <div class="col-12 col-md-11 article-item bg-white shadow-sm rounded-4 mb-4 px-0">
                        <a href="{{ "/article/".$recommend_article->id }}" class="d-flex flex-md-row flex-column">
                            <div class="article-image h-auto w-100">
                                <img class="object-fit-cover w-100 h-100 rounded-4 lozad"
                                     data-src="{{ $recommend_article->image }}"
                                     alt="">
                            </div>
                            <div class="article-content text-black p-4 p-md-5 d-flex flex-column justify-content-between">
                                <div class="article-head">
                                    <div class="article-category fs-7 text-black-50 fw-bold mb-2">{{ $recommend_article->subtitle }}</div>
                                    <div class="article-title fw-bolder fs-3">{{ $recommend_article->title }}
                                    </div>
                                </div>
                                <div class="article-time text-black-50 fs-7 fw-semi-bold mt-3">{{ $recommend_article->updated_at }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @break($index==0)
            @endforeach

            <div class="row mx-1 justify-content-evenly">
                @foreach($recommend_articles as $index => $recommend_article)
                    @if($index > 0)
                        @if($index ==1 || $index == 2)
                            <div class="col-12 col-md-5 col-lg-5 article-item bg-white shadow-sm rounded-4 my-4 px-0">
                                <a href="{{ "/article/".$recommend_article->id }}" class="d-flex flex-column">
                                    <div class="article-image h-auto">
                                        <img class="object-fit-cover w-100 h-100 rounded-top-4 lozad"
                                             data-src="{{ $recommend_article->image }}"
                                             alt="" style="max-height: 250px !important;">
                                    </div>
                                    <div class="article-content text-black p-3 p-md-3 d-flex flex-column justify-content-between">
                                        <div class="article-head">
                                            <div class="article-category fs-7 text-black-50 fw-bold mb-2">{{ $recommend_article->subtitle }}</div>
                                            <div class="article-title fw-bolder fs-4">
                                                {{ $recommend_article->title }}
                                            </div>
                                        </div>
                                        <div class="article-time text-black-50 fs-7 fw-semi-bold mt-3">{{ $recommend_article->created_at }}</div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col-12 col-md-5 col-lg-3 article-item bg-white shadow-sm rounded-4 my-4 px-0 me-1">
                                <a href="{{ "/article/".$recommend_article->id }}" class="d-flex flex-column">
                                    <div class="article-image h-auto">
                                        <img class="object-fit-cover w-100 h-100 rounded-top-4 lozad"
                                             data-src="{{ $recommend_article->image }}"
                                             alt="" style="max-height: 250px !important;">
                                    </div>
                                    <div class="article-content text-black p-3 p-md-3 d-flex flex-column justify-content-between">
                                        <div class="article-head">
                                            <div class="article-category fs-7 text-black-50 fw-bold mb-2">{{ $recommend_article->subtitle }}</div>
                                            <div class="article-title fw-bolder fs-5">{{ $recommend_article->title }}</div>
                                        </div>
                                        <div class="article-time text-black-50 fs-7 fw-semi-bold mt-3">{{ $recommend_article->created_at }}</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach

            </div>
        </div>
    </section>


    <!--更多文章-->
    <section class="bg-white">
        <div class="container py-4">
            <h2 class="my-4 mx-1 article-title fw-bolder">更多文章</h2>
            <div class="row mx-1">
                @foreach($random_articles as $random_article)
                    <div class="col-12 col-md-6 article-item py-4 border-bottom border-secondary-subtle">
                        <a href="{{ "/article/".$random_article->id }}" class="d-flex ">
                            <div class="article-image h-auto w-50">
                                <img class="object-fit-cover w-100 h-100 rounded-4 lozad"
                                     data-src="{{ $random_article->image }}"
                                     alt="">
                            </div>
                            <div class="article-content text-black p-3 d-flex flex-column justify-content-between">
                                <div class="article-head">
                                    <div class="article-category fs-7 text-black-50 fw-bold mb-2">{{ $random_article->subtitle }}</div>
                                    <div class="article-title fw-bold">{{ $random_article->title }}</div>
                                </div>
                                <div class="article-time text-black-50 fs-7 fw-semi-bold mt-3">{{ $random_article->created_at }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-3 text-center">
                <a href="/category/"
                   class="read-more btn text-black fs-6 fw-bold btn-outline-dark rounded-5 px-3">阅读历史文章</a>
            </div>
        </div>

    </section>
@endsection
