@extends('layouts.app')
@section('title', 'Category')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block mt-4">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('danger'))
  <div class="alert alert-danger alert-block mt-4">
    <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
  </div>
  @endif
        </div>
</div>
    <div class="row justify-content-center">
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add Category</div>

                <div class="card-body">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Category Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}" >

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <div class="card">
        <div class="card-header">Category List</div>

                <div class="card-body">
            <table class="table ">
            <tr>
                <th>Sr. No.</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            @if(count($categories)>0)
            @foreach($categories as $key=>$c)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $c->category_name }}</td>
                <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cat{{ $c->id }}">
                    Edit
                </button>
                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger">
                    Delete
                </button></a>
                <form action="{{ route('categories.destroy', $c->id) }}" method="post">
                  @method('DELETE')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
            <td colspan="3">No Data Available</td>
            </tr>
            @endif
            </table>
            </div>
            {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

@foreach($categories as $c)
<!-- The Modal -->
<div class="modal" id="cat{{ $c->id }}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form method="post" action="{{ route('categories.update', $c->id) }}">
      @csrf 
      @method('PUT')
      <div class="modal-body">
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ $c->category_name }}" >
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
            Update
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endforeach
@endsection
