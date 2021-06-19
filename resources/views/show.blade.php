@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">{{ $ringtone->title }}</div>

                <div class="card-body row align-items-center">
                    <audio class="ml-5" controls controlsList="nodownload" onplay="pauseOthers(this);">
                        <source src="/audio/{{ $ringtone->file }}" type="audio/mpeg">
                        Your browser does not support the audio
                    </audio>
                    <div class="ml-auto mr-5">
                        <form action="{{ route('ringtone.download', [$ringtone->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">Download</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="addthis_inline_share_toolbox"></div>
            <table class="table mt-4">
                <tr>
                    <th>Name</th>
                    <td>{{ $ringtone->title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $ringtone->description }}</td>
                </tr>
                <tr>
                    <th>Format</th>
                    <td>{{ $ringtone->format }}</td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>{{ round($ringtone->size)*0.001,2 }} kb</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $ringtone->category->name }}</td>
                </tr>
                <tr>
                    <th>Download</th>
                    <td>{{ $ringtone->download }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 mt-5">
            <div class="card-header font-weight-bold"> Categories </div>
            @foreach (App\Models\Category::all() as $category)
            <div class="card-header" style='background-color: #ccc;'>
                <a href="{{ route('ringtone.category', [$category->id]) }}">{{ $category->name }}</a>
            </div>
            @endforeach
        </div>
    </div>
    <div id="wpac-comment"></div>
</div>

@endsection