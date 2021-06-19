@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">Ringtones</div>
                <span class="mt-2 ml-3">
                    <a href="{{ route('ringtones.create') }}">
                        <button class="btn btn-primary">Create Ringtone</button>
                    </a>
                </span>
                <div class="card-body">
                    <table class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">File</th>
                                <th scope="col">Category</th>
                                <th scope="col">Size</th>
                                <th scope="col">Download</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($ringtones)>0)
                            @foreach ($ringtones as $key => $ringtone )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $ringtone->title }}</td>
                                <td>{{ $ringtone->description }}</td>
                                <td>
                                    <audio controls onplay="pauseOthers(this);">
                                        <source src="/audio/{{ $ringtone->file }}" type="audio/mpeg">
                                        Your browser does not support the audio
                                    </audio>
                                </td>
                                <td>{{ $ringtone->category->name }}</td>
                                <td>{{ $ringtone->size }} bytes</td>
                                <td>{{ $ringtone->download }}</td>
                                <td>
                                    <a href="{{ route('ringtones.edit', [$ringtone->id]) }}">
                                        <button class="btn btn-info">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Are you sure want to delete?')"
                                        action="{{ route('ringtones.destroy', [$ringtone->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td>There no ringtones</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $ringtones->links() }}
        </div>
    </div>
</div>

@endsection