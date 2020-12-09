@extends('layout')

@section('content')

@push('style')
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/css/adminlte.min.css">
@endpush

<section class="pages container mb-5">

    @includeIf($post->typeViewImageOrCarousel(), ["post" => $post,  "marginNegative" => "margin-negative"])

    <div class="page page-about post py-5">

        @if ($post->category)
            <header class="container-flex space-between">
                <div class="post-category">
                    <a href="{{ route('pages.category.show.posts', $post->category) }}" class="category text-capitalize">{{ $post->category->name }}</a>
                </div>
            </header>
        @endif

        <h1 class="text-capitalize">{{$post->title}}</h1>
        <cite>{{$post->extract}}</cite>

        <div class="date">
            <span class="c-gray-1 small">{{$post->published_at ? $post->published_at->diffForHumans() : null}}</span>
        </div>

        @if ($post->iframe)
            @include('public.post._iframe', ["iframe" => $post->iframe])
        @endif

        <div class="divider-2" style="margin: 35px 0;"></div>
        <div class="image-w-text">
            {!! $post->body !!}
        </div>
    </div>

</section>

@endsection

@push('script')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>

@endpush