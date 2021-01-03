@extends('layout')

@section('title', 'Blog')

@section('content')
    
	<section class="posts container">

        @isset($title)
            <h1 class="text-capitalize text-principal">{{ $title }}</h1>
        @endisset

        @forelse ($posts as $post)
            
            <article class="post w-image">

				@if ($post->typeViewImageOrCarousel("blog"))	
					@includeIf($post->typeViewImageOrCarousel("blog"), ["post" => $post, "marginNegative" => ""])	
				@elseif ($post->iframe)
					@include('public.post._iframe', ["iframe" => $post->iframe])
				@else
					
				@endif

				<div class="content-post">
					<header class="container-flex space-between">
						<div class="date">
							<span class="c-gray-1">{{$post->published_at->diffForHumans()}}</span>
						</div>
						@if ($post->category)	
							<div class="post-category">
								<a href="{{ route('pages.category.show.posts', $post->category) }}" class="category text-capitalize">{{ $post->category->name }}</a>
							</div>
						@else
							<div class="post-category">
								<a href="#" class="category text-capitalize">Sin Categoría</a>
							</div>
						@endif
					</header>
					<h1> {{ $post->title }} </h1>
					<div class="divider"></div>
					<p>{{ $post->extract }}</p>
					<footer class="container-flex space-between">
						<div class="read-more">
							<a href="{{ route('pages.show.post', $post) }}" class="text-uppercase c-green">Leer más</a>
						</div>
						<div class="tags container-flex">
							@forelse ($post->tags as $tag)
								<span class="tag">
									<a href="{{ route('pages.tag.show.posts', $tag) }}" class="enlace-tag"># {{ $tag->name }}</a>
								</span>	
							@empty
								<span class="tag enlace-tag">Sin etiquetas</span>	
							@endforelse
						</div>
					</footer>
				</div>
            </article>
            
		@empty
            
            <div class="content-post">
                <header class="container-flex space-between">
                    <h1> Lo sentimos, no tenemos Posts aún en el Blog. </h1>
					<div class="divider"></div>
					<p>Vuelve más tarde ....</p>
                </header>
            </div>

		@endforelse



	</section><!-- fin del div.posts.container -->

	{{ $posts->links() }}
	
@endsection
