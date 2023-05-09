@extends('layouts.app')
@section('title',$article->title)

<link href="/css/highlight.css" rel="stylesheet">
<link rel="stylesheet" href="/css/article.css">
@section('content')
    <!--文章详情-->
    <section class="min-vh-100 mt-3 mb-5">
        <div class="container py-2">
            <div class="bg-white mx-auto p-4" style="max-width: 860px">
                <div class="article-title text-center">
                    <div class="py-2 fw-bold text-secondary ">
                        <span class="fs-7 me-1">{{ $article->subtitle }}</span>
                        <span class="fs-7">{{ $article->created_at }}</span>
                    </div>
                    <div class="fs-1 fw-bolder mt-2 mx-auto">{{ $article->title }}</div>
                    @if(count($article->categories))
                        <div class="mt-4">
                            @foreach($article->categories as $category)
                                <a href="{{ "/category/".$category->name }}"
                                   class="btn btn-primary btn-sm rounded-5 px-3 me-2">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    @endif
                    <hr>
                </div>

                <div class="title-content" id="article-content" style="display: none">
                    {{ $article->content }}
                </div>

            </div>

        </div>
    </section>
@endsection

<script type="text/javascript" src="/scripts/marked.min.js"></script>
<script type="text/javascript" src="/scripts/highlight.min.js"></script>
<script type="text/javascript">

    window.onload = function () {

        let article_content = document.getElementById('article-content')
        let md = window.markdownit({
            html: true,
            linkify: true,
            typographer: true,
            langPrefix: 'language-',
            highlight: function (str, lang) {
                if (lang && hljs.getLanguage(lang)) {
                    return '<pre class="hljs"><code>' +
                        hljs.highlight(lang, str, true).value +
                        '</code></pre>';
                }
                return '<pre class="hljs"><code>' + md.utils.escapeHtml(str) + '</code></pre>';
            }
        });

        article_content.innerHTML = md.render(
            article_content.innerHTML
                .trim()
                .replaceAll('&gt;', '\>')
                .replaceAll('&amp;', '\&')
                .replaceAll('&commat;', '\@')
                .replaceAll('&excl;', '\!')
                .replaceAll('&colon;', '\:')
                .replaceAll('&comma;', '\,')
                .replaceAll('&lsquo;', '\&')
        )

        article_content.style.display = "block";
    }


</script>