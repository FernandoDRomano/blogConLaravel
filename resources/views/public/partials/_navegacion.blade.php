<header class="space-inter">
    <div class="container container-flex space-between">
        <a href="{{ route('pages.blog') }}">
            <figure class="logo"><img src="/img/logo.png" alt=""></figure>
        </a>
        <nav class="custom-wrapper" id="menu">
            <div class="pure-menu"></div>
            <ul class="container-flex list-unstyled">
                <li><a href="{{ route('pages.blog') }}" class="text-uppercase">Home</a></li>
                <li><a href="{{ route('pages.about') }}" class="text-uppercase">About</a></li>
                <li><a href="{{ route('pages.archive') }}" class="text-uppercase">Archive</a></li>
                <li><a href="{{ route('pages.contact') }}" class="text-uppercase">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>