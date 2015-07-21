{!! Form::open(array('route' => array('comment.answer', 'id' => $comment->id ), 'comment_id' => $comment->id, 'class' => 'answer-comment-form')) !!}
    <div class="form-group">
        {!! Form::textarea('comment', null, ['size' => '30x2']) !!}             
    </div>
    <div class="form-group">    
        {!! Form::submit('Send', ['class'=>'btn btn-primary', 'comment_id' => $comment->id]) !!}             
    </div>        
{!! Form::close() !!}