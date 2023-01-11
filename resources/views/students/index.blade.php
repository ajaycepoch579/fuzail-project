@extends('students.layout')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="container-fluid my-4" >
<div class="row ">
<div class="col-sm-12 col-md-4 col-lg-4">
  <div class="pull-left">
                <h2 class="">MyAssignment</h2>
  </div>
</div>
  <div class="col-sm-12 col-md-4 col-lg-5">
  </div>
  <div class="col-sm-12 col-md-4 col-lg-3">
    <form action="{{ route('logout') }}" method="post">
    @csrf
    <label class="font-weight-bold">{{ auth()->user()->name }}</label>
    <button class="btn btn-danger" type="submit">Logout</button>
</form>
  </div>
</div>
</div>
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <!-- <h2>Student Record</h2> -->
            </div>
            <div class="pull-right">
               <a class="btn btn-success" href="{{ route('students.add') }}"> Add Student Record</a>
               <a class="btn btn-success" href="{{ route('departments.index') }}">Departments</a>
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
  
  <table class="table table-bordered">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <td>Class</td>
          <td>Roll Number</td>
          <td>Department</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <?php $i = 1; ?>
    <tbody>
       @if($student->isNotEmpty())
        @foreach($student as $students)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$students->name}}</td>
            <td>{{$students->class}}</td>
            <td>{{$students->roll_number}}</td>
            <td>{{$students->department ? $students->department->name:""}}</td>
            <td class="text-center">
                <a href="{{ route('students.edit', $students->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                <a href="{{ route('students.show', $students->id)}}" class="btn btn-primary btn-sm"">Show</a>
                <form action="{{ route('students.destroy', $students->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('POST')
                    <!-- <button class="btn btn-danger btn-sm"" type="submit">Delete</button> -->
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                  </form>
                  <a class="btn btn-success btn-sm" href="{{ route('students.addimage',$students->id) }}"> Add Image</a>
            </td>
        </tr>
        @endforeach
        @else 
    <div>
        <h2>No Record Found</h2>
    </div>
@endif
    </tbody>
  </table>
  <div class="row">
    <div class="col-sm-12 col-md-9"></div>
    <div class="col-sm-12 col-md-3">
    {!! $student->links() !!} 
    </div>
  </div>

<div>
@endsection
