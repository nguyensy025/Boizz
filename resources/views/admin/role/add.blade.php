@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('css')
<link href="{{ asset('admins\roles\add.css') }}" rel="stylesheet" />
@endsection

@section('js')
<script src="{{ asset('admins\roles\add.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'role', 'key' => 'Add'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data" class="col-md-12">
                    <div class="col-md-12">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control " placeholder="Enter name">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Display name</label>
                            <textarea name="display_name" class="form-control" id="" cols="30" rows="4">{{ old('display_name') }}</textarea>
                            @error('display_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" class="checkall">
                                    Check all
                                </label>
                            </div>
                            @foreach($permissionsParent as $permissionsParentItem)
                            <div class="card bg-light mb-3 col-md-12">
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox" class="box-15px checkbox_wrapper" name="" id="" value="">
                                        {{ $permissionsParentItem->name }}
                                    </label>
                                </div>
                                <div class="row">
                                    @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem) 
                                        <div class="card-body col-md-3>
                                                    <label class="font-weight-normal text-primary">
                                            <input type="checkbox" class="box-15px checkbox_childrent" name="permission_id[]" id="" value="{{ $permissionsChildrentItem->id }}">
                                                {{ $permissionsChildrentItem->name }}
                                            </label>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection