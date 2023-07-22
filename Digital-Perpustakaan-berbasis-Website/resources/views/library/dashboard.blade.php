@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Success!</strong> {{session('success')}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @empty($books)
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <span class="alert-text"><strong>Library is empty</strong></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-1">DigiPus</h6>
                    <p class="text-sm">Book List</p>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        @foreach($books as $book)

                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="image-container">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="{{asset('storage/'. $book->cover)}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                    </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">{{$book->category->name}}</span>
                                    <a href="javascript:;">
                                        <h5>
                                            {{$book->title}}
                                        </h5>
                                    </a>
                                    <p class="mb-4 text-sm">
                                        {{$book->description}}
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0" disabled>Jumlah: {{$book->amount}}</button>
                                    </div>
                                </div>
                        </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endempty
@endsection
