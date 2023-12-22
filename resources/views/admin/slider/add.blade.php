@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('css')
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'slider', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên slider</label>
                            <input type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Nhập tên slider">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input type="file" 
                                name="image_path" 
                                value="{{ old('name') }}"
                                class="form-control-file @error('image_path') is-invalid @enderror">
                            @error('image_path')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
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