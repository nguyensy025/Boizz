@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    @include('partials.content-header', ['name' => 'menus', 'key' => 'Edit'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <form action="{{ route('menus.update', ['id' => $menuFollowIdEdit->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <input type="text" name="name" value="{{ $menuFollowIdEdit->name }}" class="form-control" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục cha</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">None</option>
                            {{!! $optionSelect !!}}
                        </select>
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