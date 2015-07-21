<div class="comment-block" comment_id="{{$comment->id}}" post_id="{{$postId}}">
    <div>
        {{ $comment->comment }}
    </div>
    <div>
        <i>Created : {{ $comment->created_at }}</i>
    </div>
</div>