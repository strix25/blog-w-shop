@extends('layouts.admin')

@section('title')
    Admin Posts
@endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                Admin Products
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><img src="{{ $product->thumbnail}}" width="100"></td>
                            <td class="text-nowrap"><a href="{{ route('adminEditProduct', $product->id)}}">{{ $product->title }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }} USD</td>
                            <td>
                                <a href="{{ route('adminEditProduct', $product->id) }}"class="btn btn-warning"><i class="icon icon-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
@endsection