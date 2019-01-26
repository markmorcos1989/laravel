@extends('layouts.front')

@section('heading')
    <h4>Edit Thread</h4>
@endsection

@section('content')

    <div class="row">
        <div class=" well">
            <form class="form-vertical" action="/posts/{{ $post->id }}" method="post" role="form"
                  id="create-thread-form">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                           value="{{$post->subject}}">
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" name="type" id="" placeholder="Input..."
                           value="{{$post->type}}">
                </div>

                <div class="form-group">
                    <label for="thread">Thread</label>
                    <textarea class="form-control" name="post" id="" placeholder="Input..."> {{$post->post}} </textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection