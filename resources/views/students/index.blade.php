@extends('students.layout')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Student Record</h2>
            </div>
            <div class="pull-right">
               <a class="btn btn-success" href="{{ route('students.add') }}"> Add Student Record</a>
            </div>
        </div>
    </div>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <td>Class</td>
          <td>Roll Number</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($student as $students)
        <tr>
            <td>{{$students->id}}</td>
            <td>{{$students->name}}</td>
            <td>{{$students->class}}</td>
            <td>{{$students->roll_number}}</td>
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
    </tbody>
  </table>
<div>
@endsection