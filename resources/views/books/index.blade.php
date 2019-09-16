@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @foreach ($books as $book)
                        <li>
                            {{ $book->title }} | {{ $book-> author }} | {{ $book->year }}
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
