@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    @include('partials.content-header', ['name' => 'menus', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <form action="{{ route('menus.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên menu</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên tên menu">
                    </div>
                    <div class="form-group">
                        <label for="">Menu cha</label>
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