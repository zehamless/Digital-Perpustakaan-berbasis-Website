@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('books.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Book Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                   placeholder="booktitle" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Category <span class="text-danger">*</span></label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description <span class="text-danger">*</span></label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                      name="description" placeholder="description" required></textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="amount">Amount <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount"
                   placeholder="amount" required>
            @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="cover">Cover <span class="text-danger">*</span></label>
            <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover"
                   placeholder="cover" required>
            @error('cover')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="file">File <span class="text-danger">*</span></label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file"
                   placeholder="pdf" required>
            @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
