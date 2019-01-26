@extends('layouts.front')

@section('heading',"Create Thread")

@section('content')

    <div class="row">
        <div class=" well">
            <form class="form-vertical" action="/posts" method="post" role="form"
                  id="create-thread-form">
                @csrf
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                           value="{{old('subject')}}">
                </div>

                {{--<div class="form-group">
                    <label for="subject">type</label>
                    <input type="text" class="form-control" name="type" id="" placeholder="Input..."
                           value="{{old('type')}}">
                </div>--}}

                <div class="form-group">
                    <label for="tag">Tags</label>
                    <select name="tags" multiple id="tag">
                        {{-- todo add from db--}}
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="thread">Thread</label>
                    <textarea class="form-control" name="post" id="" placeholder="Input..."
                    > {{old('post')}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

    <script>
        $(function () {
            $('#tag').selectize();
        })
    </script>
@endsection
