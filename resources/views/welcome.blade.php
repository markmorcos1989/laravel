@extends('layouts.app')

@section('content')
    @if(auth::guest())
        <div class="container">
            <div class="jumbotron">
                <h1>Join Webdevmatics Community</h1>
                <p>Help and get help</p>
                <p>
                    <a class="btn btn-primary btn-lg" href="{{ route('login') }}">login</a>
                    <a class="btn btn-primary btn-lg" href="{{ route('register') }}">register</a>
                </p>
            </div>
        </div>
    @else
        
    @endif
@endsection


