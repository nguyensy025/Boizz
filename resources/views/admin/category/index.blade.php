@extends('layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'category', 'key' => 'List'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-2">Add</a>
        </div>
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach($categories as $category)
              <tr>
                <th scope="row">{{ $category['id'] }}</th>
                <td>{{ $category['name'] }}</td>
                <td>
                  <a href="{{ route('categories.edit', $category['id']) }}" class="btn btn-secondary mr-2">Edit</a>
                  <a href="{{ route('categories.delete', $category['id']) }}" class="btn btn-primary">Remove</a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          {{ $categories->links('pagination::bootstrap-5') }}
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection