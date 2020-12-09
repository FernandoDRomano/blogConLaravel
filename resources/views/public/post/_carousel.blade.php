<div id="carousel-images" class="carousel slide margin-negative" data-ride="carousel">
   
    <ol class="carousel-indicators">
        @foreach ($post->images as $image)
            <li 
                data-target="#carousel-images" 
                data-slide-to="{{ $loop->index }}" 
                class="{{ $loop->first ? 'active' : '' }}">
            </li>
        @endforeach
    </ol>

    <div class="carousel-inner">
        @foreach ($post->images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="/storage/{{ $image->url }}" alt="" class="d-block w-100">
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#carousel-images" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-images" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div> 
