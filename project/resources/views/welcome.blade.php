@extends('app')
@section('title', 'MainPage')
@section('content')
    <div class="title m-b-md">
        ClickManager
    </div>

    <div class="links">
        <a href="/click?param1=12&param2=14">click1</a>
        <a href="/click?param1=22&param2=24">click2</a>
        <a href="/click?param1=32&param2=44">click3</a>
    </div>

    </br>

    <table id="example" class="display" border="1">
        <thead>
        <tr>
            <td>id</td>
            <th>ip</th>
            <th>ref</th>
            <th>param1</th>
            <td>param2</td>
            <th>error</th>
            <th>bad domain</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clicks as $click)
            <tr>
                <td>{{$click->getId()}}</td>
                <td>{{$click->getIp()}}</td>
                <td>{{$click->getRef()}}</td>
                <td>{{$click->getParam1()}}</td>
                <td>{{$click->getParam2()}}</td>
                <td>{{$click->getError()}}</td>
                <td>{{$click->getBadDomain()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
