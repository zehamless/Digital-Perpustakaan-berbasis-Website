@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
            @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong>Error,</strong> {{session('error')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&#215;</span>
                        </button>
                    </div>

            @endif
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Books List</h6>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
                            <a href="{{ route('books.export') }}" class="btn btn-success">Export</a>
                        </div>
                        <div>
                        <select id="category-filter">
                            <option value="">Category Filter</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center">Title</th>
                                    <th class="align-middle text-center">Category</th>
                                    <th class="align-middle text-center">Amount</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="filteredData">
                                <!-- Data loaded -->
                                </tbody>
                            </table>
                            <div id="paginationContainer">
                                <ul class="pagination justify-content-center"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
