@extends('layouts.admin')

@section('title') 
Edit product
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        	Edit Product
                    </div>

                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('adminEditProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Thumbnail</label>
                                        <input type="file" name="thumbnail" id="normal-input" class="form-control" placeholder="Post title">
                                    </div>
                                    <img src="{{ asset($product->thumbnail) }}" alt="" width="100">
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Title</label>
                                        <input name="title" id="normal-input" class="form-control" value="{{ $product->title }}" placeholder="Title">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">Description</label>
                                        <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Product description">{{ $product->description }}</textarea>
                                    </div>
                                </div>                           
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">Price</label>
                                        <input name="price" id="normal-input" class="form-control" value="{{ $product->price }}" placeholder="10.00">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Update product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection