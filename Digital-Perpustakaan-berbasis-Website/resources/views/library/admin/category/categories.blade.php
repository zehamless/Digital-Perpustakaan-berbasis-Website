@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>List Category</h6>
                    </div>
                    <div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block btn-default mb-3" data-bs-toggle="modal"
                                    data-bs-target="#modal-form">Form
                            </button>
                            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"
                                 aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-info text-gradient">Add
                                                        Category</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form role="form text-left" action="{{route('categories.store')}}"
                                                          method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name" class="col-form-label">Name: <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="name" name="name" required>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit"
                                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$category->name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-block btn-default mb-3" data-bs-toggle="modal"
                                                    data-bs-target="#modal-update-{{$category->id}}">Edit
                                            </button>
                                            <div class="modal fade" id="modal-update-{{$category->id}}" tabindex="-1" role="dialog"
                                                 aria-labelledby="modal-form" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header pb-0 text-left">
                                                                    <h3 class="font-weight-bolder text-info text-gradient">Update
                                                                        Category</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form role="form text-left" action="{{route('categories.update', $category)}}"
                                                                          method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="name" class="col-form-label">Name: </label>
                                                                            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" required>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <button type="submit"
                                                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                                                                Submit
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$category->id}}">
                                                Delete
                                            </button>
                                            <div class="modal fade" id="delete-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure want to delete {{$category->name}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form id="delete-form" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-primary">Sure</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
