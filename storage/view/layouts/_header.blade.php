<header class="bg-white fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg"
             style="opacity: 0.8;backdrop-filter: saturate(180%) blur(20px);background: #ffffff">
            <div class="container-fluid align-items-center">
                <a class="d-block navbar-brand" href="/" title="olaf blog" style="height: 40px">
                    <img src="/images/logo.jpg" alt="olaf" class="img-fluid w-100 h-100 rounded-5">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        @foreach(($categories = App\Model\Category::query(true)->where('is_recommend', true)->get()) as $category)
                            <li class="nav-item">
                                <a class="nav-link text-secondary-emphasis"
                                   href="{{ "/category/".$category->name }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link text-secondary-emphasis" href="/about">about</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
</header>