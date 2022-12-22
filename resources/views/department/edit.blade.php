@extends('departments.layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit & Update</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{ route('departments.index') }}"> Back</a>
            </div>
        </div>
    </div>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('departments.update', $departments->id) }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $departments->name }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update Department</button>
      </form>
  </div>
</div>
@endsection