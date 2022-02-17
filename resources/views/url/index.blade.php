@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('messages.Sites') }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <th>ID</th>
                    <th>{{ __('messages.Name') }}</th>
                    <th>{{ __('messages.Last check') }}</th>
                    <th>{{ __('messages.Status code') }}</th>
                </tr>
                @if ($urls)
                    @foreach ($urls as $url)
                        <tr>
                            <td>{{ $url->id }}</td>
                            <td scope="row"><a href="{{ route('urls.show', ['url' => $url->id]) }}">{{ $url->name }}</a></td>
                            <td>{{ $lastChecks[$url->id]->created_at ?? ''}}</td>
                            <td>{{ $lastChecks[$url->id]->status_code ?? '' }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
            <nav>
                <ul class="pagination">
                <li>{{ $urls->onEachSide(5)->links() }}</li>
                </ul>
            </nav>
        </div>
    </div>
</main>
@endsection
