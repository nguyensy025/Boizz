@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('css')
<link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\user\add\add.css') }}" rel="stylesheet" />
@endsection

@section('js')
<script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
<script src="{{ asset('admins\user\add\add.js') }}"></script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'user', 'key' => 'Edit'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên user</label>
                            <input type="text" 
                                name="name" 
                                value="{{$user->name}}"
                                class="form-control" 
                                placeholder="Nhập tên người dùng">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" 
                                name="email" 
                                value="{{$user->email}}"
                                class="form-control" 
                                placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" 
                                name="password" 
                                value="{{ old('password') }}"
                                class="form-control" 
                                placeholder="Nhập password">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <select name="role_id[]" class="form-control select2-init" multiple>
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option 
                                        {{ $rolesUser->contains('id', $role->id) ? 'selected' : '' }}
                                        value="{{$role->id}}">{{$role->name}}
                                    </option>
                                @endforeach
                            </select>
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