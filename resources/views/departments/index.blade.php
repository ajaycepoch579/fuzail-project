@extends('departments.layout')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="container-fluid">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Departments</h2>
            </div>
            <div class="pull-right">
               <a class="btn btn-success" href="{{ route('departments.add') }}"> Add Department</a>
            </div>
        </div>
    </div>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <div class="row my-4">
    <div class="col-sm-12 col-md-8"></div>
    <div class="col-sm-12 col-md-4">
    <form action="" method="GET">
    <input type="text" name="search"/>
    <button type="submit" class="btn btn-primary">Search</button>
    </form>
    </div>
  </div>
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <!-- <td>Class</td>
          <td>Roll Number</td> -->
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
        <tr>
            <td>{{$department->id}}</td>
            <td>{{$department->name}}</td>
           
            <td class="text-center">
                <a href="{{ route('departments.edit', $department->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                <a href="{{ route('departments.show', $department->id)}}" class="btn btn-primary btn-sm"">Show</a>
                <form action="{{ route('departments.destroy', $department->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('POST')
                    <!-- <button class="btn btn-danger btn-sm"" type="submit">Delete</button> -->
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="col-sm-12 col-md-9"></div>
    <div class="col-sm-12 col-md-3">
    {!! $departments->links() !!} 
    </div>
  </div>
<div>
</div>
@endsection