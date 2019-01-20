@extends('app')
@section('title', 'ErrorPage')
@section('content')
    <div>
        redirect - {{(session()->get('redirect')) ? 'YES' : 'NO'}}
    </div>
    <div class="title m-b-md">
        ERROR - {{$click_id}}
    </div>
@endsection
@section('scripts')
    @if(session()->get('redirect'))
        setTimeout('location="https://www.google.com/"', 5000);
    @endif
@stop
