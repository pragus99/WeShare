@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8">
            @foreach ($ringtones as $ringtone)

            <div class="card mt-4">
                <div class="card-header font-weight-bold">{{ $ringtone->title }}</div>

                <div class="card-body row align-items-center">
                    <audio class="ml-5" controls onplay="pauseOthers(this);" controlsList="nodownload">
                        <source src="/audio/{{ $ringtone->file }}" type="audio/mpeg">
                        Your browser does not support the audio
                    </audio>
                    <div class="ml-auto mr-5">
                        <a href="{{ route('ringtone.show', [$ringtone->id,$ringtone->slug]) }}"> <button
                                class="btn btn-info">Info and Download</button> </a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

        <div class="col-md-4 mt-4 ml-auto">
            <div class="card-header font-weight-bold"> Categories </div>
            @foreach (App\Models\Category::all() as $category)
            <div class="card-header" style='background-color: #ccc;'>
                <a href="{{ route('ringtone.category', [$category->id]) }}">{{ $category->name }}</a>
            </div>
            @endforeach
        </div>
        {{ $ringtones->links() }}
    </div>
</div>
@endsection