<div class="comment">
    <div style="background-color:grey;display:flex;align-items:center;">
        @if($comment->image)
            <img class="small-image" src="{{ Vite::asset('public/images/resize_' . $comment->image) }}">
        @else
            <img class="small-image" src="{{ Vite::asset('resources/images/anon.png') }}">
        @endif
        <span style="margin-left: 15px;"><strong>{{ $comment->username }}</strong> {{ $comment->created_at->format('d.m.Y в H:i') }}</span>
    </div>

    <p> {!! $comment->text !!}</p>
    <button class="reply-button" id="reply-button" onclick="openPopup({{ $comment->id }})">Ответить</button>
    @foreach ($comment->replies as $replies)
        <div class="replies">
            @include('comments.comment', ['comment' => $replies])
        </div>
    @endforeach
</div>
