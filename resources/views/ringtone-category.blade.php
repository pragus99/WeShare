@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if(count($ringtones)>0)
            @foreach($ringtones as $ringtone)
            <div class="card mt-4">
                <div class="card-header">{{ $ringtone->title }}</div>

                <div class="card-body">
                    <audio controls onplay="pauseOthers(this);" controlsList="nodownload">
                        <source src="/audio/{{ $ringtone->file }}" type="audio/mpeg">
                        Your browser does not support the audio
                    </audio>
                </div>
                <div class="card-footer">
                    <a href="{{ route('ringtone.show', [$ringtone->id,$ringtone->slug]) }}">Info and Download</a>
                </div>
            </div>
            @endforeach
            @else
            <p>There no ringtones for this category</p>
            @endif
        </div>
        <div class="col-md-4 mt-4">
            <div class="card-header"> Categories </div>
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