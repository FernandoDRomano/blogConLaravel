<div class="grid-container">
    @foreach ($post->images->take(4) as $image)
        <div class="item">
            <img src="/storage/{{ $image->url }}" alt="" class="">
            @if ($loop->last && $post->images->count() > 4)
                <p class="text-font">+ {{ $post->countImagesForGrid()}}</p>
            @endif
        </div>
    @endforeach
</div>