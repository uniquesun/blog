@extends('layouts.app')
@section('title','关于我')

@section('content')
    <section class="mt-3">
        <div class="mx-3">
            <div class="container bg-white p-3 shadow-sm rounded-2 mb-3">
                <h4 class="my-4 mx-1 article-title fw-bolder">关于我</h4>
            </div>
        </div>

        <div class="mx-3">
            <div class="container bg-white p-3 shadow-sm rounded-2 mb-3">
                <h4 class="my-4 mx-1 article-title fw-bolder">本博客</h4>
                <div>
                    <p>后端是 hyperf + nginx + mysql + redis。前台是 bootstrap , 后台是Vue</p>
                    <p>
                        为啥呢？公司项目是 vue + element-ui 弄的，但是SEO表现的不尽如人意。
                        本人不是专业前端，暂时对其没有相关研究。所以前台是直接是服务端渲染的。
                        后续对vue了解足够，再来对其发表看法。
                    </p>
                    <p>
                        前端UI是完全对着这位作者的博客实现的，非常感谢。地址：<a class="text-primary" href="https://github.com/austin2035/astro-air-blog" target="_blank">https://github.com/austin2035/astro-air-blog</a>
                    </p>
                    <p>
                        本项目也已开源。地址：<a class="text-primary" target="_blank" href="https://github.com/uniquesun">https://github.com/uniquesun</a>
                    </p>
                </div>
            </div>
        </div>


        <div class="mx-3">
            <div class="container bg-white p-3 shadow-sm rounded-2 mb-3">
                <h4 class="my-4 mx-1 article-title fw-bolder">联系我</h4>
                <div>
                    <p>微信</p>
                    <p>Email</p>
                    <p>GitHub</p>
                    <p>Telegram</p>
                </div>
            </div>
        </div>


    </section>
@endsection

