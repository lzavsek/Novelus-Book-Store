@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">{{ __('Add a new book') }}</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Year</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($books as $book)
                                     <td>{{ $book->id }}</td>
                                     <td>{{ $book->title }}</td>
                                     <td>{{ $book->author }}</td>
                                     <td>{{ $book->year }}</td>
                                     <td>x / {{ $book->quantity }}</td>
                                     <td><a href="{{ route('books.show', ['id' => $book->id]) }}" class="badge badge-primary">view</a> | <a href="#" class="badge badge-primary">reserve</a> | <a href="#" class="badge badge-primary">rent</a> |
                                     <a href="{{ route('books.edit', ['id' => $book->id]) }}" class="badge badge-primary">edit</a> | <a href="{{ route('books.destroy', ['id' => $book->id]) }}" class="badge badge-danger">delete</a></td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection