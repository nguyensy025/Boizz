@extends('layouts.admin')

@section('title')
<title>Edit product</title>
@endsection

@section('css')
<link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'product', 'key' => 'Edit'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Giá sản phẩm</label>
                            <input type="text" name="price" class="form-control" value="{{ $product->price }}" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="file" name="feature_image_path" class="form-control-file" placeholder="Nhập tên sản phẩm">
                            <div class="col-md-12">
                                <div class="row"><img class="product_image_150_100" src="{{ $product->feature_image_path }}" alt=""></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh chi tiết</label>
                            <input type="file" multiple name="image_path[]" class="form-control-file" placeholder="Nhập tên sản phẩm">
                            <div class="col-md-12">
                                <div class="row mt-2">
                                    @foreach($product->productImages as $productImageItem)
                                    <div class="col-md-3 overflow-hidden p-0"><img class="product_image_150_100" src="{{ $productImageItem->img_path }}" alt=""></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Mô tả</label>
                            <textarea name="contents" class="form-control" id="" rows="6">{{ $product->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nhập tags cho sản phẩm</label>
                            <select name='tags[]' class="form-control tags_select_choose" multiple="multiple">
                                @foreach($product->tags as $tagItem)
                                <option value="{{ $tagItem->name }}" selected>{{ $tagItem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn danh mục</label>
                            <select class="form-control select2_init" name="category_id">
                                <option value="0">None</option>
                                {{!! $htmlOption !!}}
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
<script src="{{ asset('admins\product\add\add.js') }}"></script>
@endsection