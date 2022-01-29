@foreach ($urls as $url)
    <p>{{ $url->id }} {{ $url->name }} {{ $url->created_at}}</p>
@endforeach
