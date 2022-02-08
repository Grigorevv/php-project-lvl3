@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main class="flex-grow-1">
    <div class="container-lg mt-3">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
                <h1 class="display-3">Анализатор страниц</h1>
                <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
                {{ Form::open(['url' => route('urls.store'), 'class' => 'd-flex justify-content-center'])  }}
                    {{ Form::text('url[name]', '', ['class' => 'form-control form-control-lg', 'placeholder' => 'https://www.example.com']) }}
                    {{ Form::submit('Проверить', ['class' => 'btn btn-lg btn-primary ms-3 px-5 text-uppercase']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</main>
@endsection
