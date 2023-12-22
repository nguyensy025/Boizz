@extends('layouts.admin')

@section('title')
<title>Add product</title>
@endsection

@section('css')
<link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'product', 'key' => 'Add'])
    <div class="col-md-12">
        <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif -->
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Nhập tên sản phẩm"
                            >
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Giá sản phẩm</label>
                            <input type="text" 
                                name="price"
                                value="{{ old('price') }}" 
                                class="form-control @error('price') is-invalid @enderror" 
                                placeholder="Nhập giá sản phẩm"
                            >
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="file" 
                            name="feature_image_path" 
                            class="form-control-file"
                        >
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh chi tiết</label>
                            <input type="file" 
                                multiple name="image_path[]" 
                                class="form-control-file"
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Mô tả</label>
                            <textarea name="contents" class="form-control" id="" rows="6">{{ old('contents') }}</textarea>
                            @error('contents')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nhập tags cho sản phẩm</label>
                            <select name='tags[]' class="form-control tags_select_choose" multiple="multiple">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn danh mục</label>
                            <select class="form-control select2_init" name="category_id">
                                <option value="">Chọn danh mục</option>
                                {{!! $htmlOption !!}}
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

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