@php /**
 * @var \Illuminate\Support\Collection|\App\Instagram\Highlight[] $highlights
 */ @endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <br><br>

                    Highlights:<br>
                    <ul>
                    @foreach($highlights as $highlight)
                        <li>{{ $highlight->title }}:
                            <ul>
                                @foreach($highlight->stories as $story)
                                    <li>
                                        <a href="{{ $story->url }}" target="_blank">
                                            {{ $story->isVideo ? 'Video' : 'Photo' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
