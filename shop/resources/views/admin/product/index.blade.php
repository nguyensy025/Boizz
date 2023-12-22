
@extends('layouts.admin')

@section('title')
<title>Product list</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection

@section('js')
<script src="{{ asset('vendors\sweetAlert2\sweetAlert2.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{ asset('admins/product/index/list.js') }}"></script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'product', 'key' => 'List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add</a>
        </div>
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên</th>
                <th scope="col">Giá</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach($product as $productItem)
              <tr>
                <td>{{ $productItem->id}}</td>
                <td>{{ $productItem->name }}</td>
                <td>{{ number_format($productItem->price) }}</td>
                <td><img class="product_image_150_100" src="{{ $productItem->feature_image_path }}" alt=""></td>
                <td>{{ optional($productItem->category)->name }}</td>
                <td><a href="{{ route('product.edit', ['id' => $productItem->id]) }}" class="btn btn-secondary mr-2">Edit</a><a href="" data-url="{{ route('product.delete', ['id' => $productItem->id]) }}" class="btn btn-primary action-delete">Remove</a></td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          {{ $product->links('pagination::bootstrap-5') }}
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection