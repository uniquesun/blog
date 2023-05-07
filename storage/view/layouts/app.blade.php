<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '分享个人经验与生活') - olaf blog</title>
    <meta name="description" content="高品质的关于 Laravel,JavaScript,Golang 个人博客。" />
    <meta name="keywords" content="olaf,laravel,laravel blog,php blog,JavaScript blog,laravel教程,laravel开源,laravel新手,laravel5" />
    <meta name="author" content="Olaf" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">

</head>

<body class="d-flex mh-100 flex-column">
@include('layouts._header')

<div class="main flex-grow-1" style="margin-top: 54px">
    @yield('content')
</div>


@include('layouts._footer')
<script src="/scripts/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/scripts/lozad.min.js"></script>
<script src="/scripts/myScript.js"></script>

</body>

</html>
