@foreach ($comments as $comment)
    @include('public.comments._item', ['comment' => $comment, 'margin' => $margin])
@endforeach