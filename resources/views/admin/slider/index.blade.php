@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection

@section('js')
<script src="{{ asset('vendors\sweetAlert2\sweetAlert2.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{ asset('admins/slider/index/list.js') }}"></script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'slider', 'key' => 'List'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('slider.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <th scope="row">{{ $slider['id'] }}</th>
                                <td>{{ $slider['name'] }}</td>
                                <td>{{ $slider['description'] }}</td>
                                <td>
                                    <img class="product_image_150_100" src="{{ $slider['image_path'] }}" alt="">
                                </td>
                                <td>
                                    <a href="{{route('slider.edit', ['id' => $slider->id])}}" class="btn btn-secondary mr-2">Edit</a>
                                    <a href="" 
                                    data-url="{{route('slider.delete', ['id' => $slider->id])}}"
                                    class="btn btn-primary action-delete">Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $sliders->links('pagination::bootstrap-5') }}
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection