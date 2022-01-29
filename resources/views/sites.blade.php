@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Последняя проверка</th>
                    <th>Код ответа</th>
                </tr>
                @foreach ($urls as $url)
                 <!-- 
                <tr>
                    <td>1</td>
                    <td><a href="https://php-l3-page-analyzer.herokuapp.com/urls/1">https://mail.ru</a></td>
                    <td>2022-01-26 19:36:45 </td>
                    <td>200</td>
                </tr> -->
                <tr>
                <td>{{$url->id}}</td>
                <td>{{$url->name}}</td>
                <td>2022-01-26 19:36:45 </td>
                <td>200</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</main>
</body>
</html>
@endsection
