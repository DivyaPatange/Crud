@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
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
        
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                <form method="POST" action="{{ route('product.update', $product->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->product_name }}" >

                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control @error('category') is-invalid @enderror" name="category">
                                <option value="">-Select Category-</option>
                                @foreach($category as $c)
                                <option value="{{ $c->id }}" {{ ($c->id == $product->category) ? 'selected=selected' : ''  }}>{{ $c->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Size</label>
                            <select class="form-control @error('size') is-invalid @enderror" name="size">
                                <option value="">-Select Size-</option>
                                @foreach($size as $s)
                                <option value="{{ $s->id }}" {{ ($s->id == $product->size) ? 'selected=selected' : ''  }}>{{ $s->size }}</option>
                                @endforeach
                            </select>
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Price (Rs.)</label>
                            <input type="number" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{ $product->product_price }}" >

                            @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stock (Pcs)</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $product->stock }}" >

                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Description</label>
                            <input type="text" class="form-control @error('product_description') is-invalid @enderror" name="product_description" value="{{ $product->product_description }}" >

                            @error('product_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    </div>
                    <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
