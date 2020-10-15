@extends('layouts.app')
@section('title', 'Product')
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
                <div class="card-header">Add Product</div>

                <div class="card-body">
                <form method="POST" action="{{ route('product.store') }}">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" >

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
                                <option value="{{ $c->id }}">{{ $c->category_name }}</option>
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
                                <option value="{{ $s->id }}">{{ $s->size }}</option>
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
                            <input type="number" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{ old('product_price') }}" >

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
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" >

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
                            <input type="text" class="form-control @error('product_description') is-invalid @enderror" name="product_description" value="{{ old('product_description') }}" >

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
        <div class="col-md-10">
        <div class="card">
        <div class="card-header">Product List</div>

                <div class="card-body">
            <table class="table ">
            <tr>
                <th>Sr. No.</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Size</th>
                <th>Price (Rs.)</th>
                <th>Stock (Pcs)</th>
                <th>Product Description</th>
                <th>Action</th>
            </tr>
            @if(count($products)>0)
            @foreach($products as $key=>$p)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $p->product_name }}</td>
                <td>
                    <?php
                        $categoryInfo = DB::table('categories')->where('id', $p->category)->first();
                    ?>
                    @if(isset($categoryInfo) && !empty($categoryInfo)){{ $categoryInfo->category_name }}@endif</td>
                <td><?php
                        $sizeInfo = DB::table('sizes')->where('id', $p->size)->first();
                    ?>
                    @if(isset($sizeInfo) && !empty($sizeInfo)){{ $sizeInfo->size }}@endif</td>
                <td>{{ $p->product_price }}</td>
                <td>{{ $p->stock }}</td>
                <td>{{ $p->product_description }}</td>

                <td>
                <a href="{{ route('product.edit', $p->id) }}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#size{{ $p->id }}">
                    Edit
                </button></a>
                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button type="button" class="btn btn-danger">
                    Delete
                </button></a>
                <form action="{{ route('product.destroy', $p->id) }}" method="post">
                  @method('DELETE')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
            <td colspan="8">No Data Available</td>
            </tr>
            @endif
            </table>
            </div>
            {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
