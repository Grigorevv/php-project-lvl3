@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<div class="container-lg">
    <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <tr>
                <td>ID</td>
                <td>{{ $url->id }}</td>
            </tr>
            <tr>
                <td>Имя</td>
                <td>{{ $url->name }}</td>
            </tr>
            <tr>
                <td>Дата создания</td>
                <td>{{ $url->created_at }}</td>
            </tr>
        </table>
    </div>
    <h2 class="mt-5 mb-3">Проверки</h2>
    {{ Form::open(['url' => route('urls.checks.store', [$url->id])]) }}
    {{ Form::submit(('Проверить'), ['class' => 'btn btn-primary mb-3']) }}
    {{ Form::close() }}
    <table class="table table-bordered table-hover text-nowrap">
        <tr>
            <th>ID</th>
            <th>Код ответа</th>
            <th>h1</th>
            <th>title</th>
            <th>description</th>
            <th>Дата проверки</th>
        </tr>
        @foreach ($checks as $check)
        <tr>
            <td>{{ $check->id }}</td>
            <th>{{ $check->status_code }}</th>
            <th>{{ Str::limit($check->h1, 30) }}</th>
            <th>{{ Str::limit($check->title, 30) }}</th>
            <th>{{ Str::limit($check->description, 30) }}</th>
            <td>{{ $check->created_at }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
