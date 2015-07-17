@extends('app')

@section('content')
<div class="col-sm-8 col-sm-offset-2">
    {!! Form::model($model) !!}
        <div class="form-group">    
            <label for="title" class="control-label">Title</label>
        </div>
        <div class="form-group">
            {!! Form::text('title', null, ['class'=>'class']) !!}             
        </div>
        <div class="form-group">    
            <label for="content" class="control-label">Content</label>
        </div>
        <div class="form-group">
            {!! Form::textarea('content', null, ['class'=>'class']) !!}             
        </div>


        <div class="form-group">    
            {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}             
        </div>

        <div class="form-group">  
            {!! Form::checkbox('publish', 1, $model->publish) !!}
        </div>
    
    {!! Form::close() !!}
</div>

@endsection