@extends('layouts.app')

@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Сайт: http://www.simple.ru</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <tr>
                        <td>ID</td>
                        <td>27</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>http://www.simple.ru</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>2022-01-28 15:43:08</td>
                    </tr>
                </table>
            </div>
            <h2 class="mt-5 mb-3">Проверки</h2>
            <form method="post" action="#">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="submit" class="btn btn-primary" value="Запустить проверку">
            </form>
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>title</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
@endsection

