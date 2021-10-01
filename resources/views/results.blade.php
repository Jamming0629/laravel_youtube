@extends('master')

@section('content')
<style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200;500&display=swap');
        .card{
            background-color: #d3d3d3;
        }
        * {
            font-family: 'Oswald', sans-serif;
        }
</style>
@yield('css')
    <div class="container mt-4 col-xs-12 col-md-6">
        <div class="row">
            <div class="col">
                @foreach($videoLists->items as $key => $item)
                    <div class="card row mb-3">
                        <div class="row no-gutters">
                            <a class="" href="{{ route('watch', $item->id->videoId) }}" style="display: contents">
                                <div class="col-6">
                                    <img src="{{ $item->snippet->thumbnails->medium->url }}" alt="" class="img-fluid">
                                </div>
                                <div class="card-body col-6">
                                    <h5>{{ \Illuminate\Support\Str::limit($item->snippet->title, $limit = 150, $end = ' ...') }}</h5>
                                    <p class="text-muted">Published
                                        at {{ date('d M Y', strtotime($item->snippet->publishTime)) }}</p>
                                    <p>{{ \Illuminate\Support\Str::limit($item->snippet->description, $limit = 300, $end = ' ...') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection