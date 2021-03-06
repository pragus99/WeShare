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
                <div class="card-header">Photos</div>
                <span class="mt-2 ml-3">
                    <a href="{{ route('photos.create') }}">
                        <button class="btn btn-primary">Create Photo</button>
                    </a>
                </span>
                <div class="card-body">
                    <table class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">File</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Format</th>
                                <th scope="col">Size</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($photos)>0)
                            @foreach ($photos as $key => $photo )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="/uploads/{{ $photo->file }}" width="100" alt="Photo">
                                </td>
                                <td>{{ $photo->title }}</td>
                                <td>{{ $photo->description }}</td>
                                <td>{{ $photo->format }}</td>
                                <td>{{ round($photo->size)*0.001,2 }}kb</td>
                                <td>
                                    <a href="{{ route('photos.edit', [$photo->id]) }}">
                                        <button class="btn btn-primary">Edit</button></a>
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Are you sure want to delete?')"
                                        action="{{ route('photos.destroy', [$photo->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td>There no photos</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $photos->links() }}
        </div>
    </div>
</div>

@endsection