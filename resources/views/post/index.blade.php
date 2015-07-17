@extends('app')

@section('content')    
    <div class="col-sm-8 col-sm-offset-2">
    <h1>All posts</h1>
    @foreach ($posts as $post)

        <h2>{{ $post->title }}</h2>
        <div style="float: right;">
            <a href="/post/createa/{{$post->id}}"><img src="/images/pencil.png" alt="Edit"></a>
        </div>
        <div style="float: right;">
            <a href="/post/delete/{{$post->id}}"><img src="/images/cross.png" alt="Delete"></a>
        </div>
        <div style="float: right;">
            <a href="/post/view/{{$post->id}}"><img src="/images/loupe.png" alt="View"></a>
        </div>
        <div>
            <div>
                {{ $post->content }}
            </div>
            <div>
                <i>Created : {{ $post->created_at }}</i>
            </div>
            
        </div>
        <hr/>
    @endforeach
    <?php echo $posts->render(); ?>

</div>
@endsection