@extends('app')

@section('content')
<div class="col-sm-8 col-sm-offset-2">
        <div class="form-group">    
            {{$model->title}}
        </div>
        <div class="form-group">    
            {{$model->content}}
        </div>
        <div class="form-group">    
            <i>{{$model->created_at}}</i>
        </div>
    
        Add comment:
        {!! Form::open(array('route' => array('comment.add', $model->id))) !!}
        <div class="form-group">
            {!! Form::textarea('comment', null, ['size' => '70x4']) !!}             
        </div>
        <div class="form-group">    
            {!! Form::submit('Send', ['class'=>'btn btn-primary']) !!}             
        </div>
        
        <hr>
        <h2>Comments</h2>
        {!! $comments !!}

    
    {!! Form::close() !!}
    
</div>

@endsection