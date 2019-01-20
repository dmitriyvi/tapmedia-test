<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
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
                            {{--<td>ua</td>--}}
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
                            {{--<td><{{$click['ua']}}/td>--}}
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
            </div>
        </div>
    </body>
    <script type="text/javascript" src="/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
</html>
