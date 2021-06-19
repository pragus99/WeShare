@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($wallpapers as $wallpaper)

        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header font-weight-bold">{{ $wallpaper->title }}</div>

                <div class="card-body">
                    <p>{{ $wallpaper->description }}</p>
                    <p><img src="/uploads/{{ $wallpaper->file }}" class="img-thumbnail"></p>
                </div>
            </div>

        </div>

        <div class="col-md-3 mt-4">
            <div class="column card container-download">
                <div class="card-header font-weight-bold">Download</div>
                <div class="card-body">
                    <p>
                        <form action=" {{ route('xlarge', [$wallpaper->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-download">
                                Download 1280x1024
                            </button>
                        </form>
                    </p>
                    <p>
                        <form action="{{ route('large', [$wallpaper->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-download">
                                Download 800x600
                            </button>
                        </form>
                    </p>
                    <p>
                        <form action="{{ route('medium', [$wallpaper->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-download">
                                Download 316x255
                            </button>
                        </form>
                    </p>
                    <p>
                        <form action="{{ route('small', [$wallpaper->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-download">
                                Download 118x95
                            </button>
                        </form>
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection