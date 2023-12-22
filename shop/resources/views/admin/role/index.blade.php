@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('css')

@endsection

@section('js')
<script src="{{ asset('vendors\sweetAlert2\sweetAlert2.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{ asset('admins/slider/index/list.js') }}"></script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'role', 'key' => 'List'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{ $role['id'] }}</th>
                                <td>{{ $role['name'] }}</td>
                                <td>{{ $role['display_name'] }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-secondary mr-2">Edit</a>
                                    <a href="" 
                                    data-url=""
                                    class="btn btn-primary action-delete">Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $roles->links('pagination::bootstrap-5') }}
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection