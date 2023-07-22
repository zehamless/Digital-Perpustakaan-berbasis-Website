@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('books.update', [$book])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Book Title </label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                   placeholder="Title" value="{{$book->title}}" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Category </label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                <option value="{{($book->category_id)}}">{{$book->category->name}}</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="description" required>{{ $book->description }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="amount">Amount </label>
            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount"
                   placeholder="amount" value="{{$book->amount}}" required>
            @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="cover"> Current Cover </label>
            <a class="d-block shadow-xl border-radius-xl">
                <img src="{{asset('storage/'. $book->cover)}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl" width="1200px" height="600px">
            </a>
            <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover"
                   placeholder="cover">
            @error('cover')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="file">Current File: </label>
            <a href="{{asset('storage/'. $book->file)}}"> {{$book->title}}</a>
            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file"
                   placeholder="pdf">
            @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
            Delete
        </button>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete {{$book->title}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="delete-form" action="{{ route('books.destroy', $book) }}" method="POST"">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-primary">Sure</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
