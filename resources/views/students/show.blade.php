@extends('students.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Student</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="container mt-5">
    <table class="table">
    <!-- <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <td>Class</td>
          <td>Roll Number</td>
          <td>Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>    
            <td>{{$students->id}}</td>
            <td>{{$students->name}}</td>
            <td>{{$students->class}}</td>
            <td>{{$students->roll_number}}</td>
            @foreach($students->images as $image)
            <td><img src="/images/{{ $image ? $image->image:"" }}" height="150px" width="350px"></td>
            @endforeach
            <td class="text-center">
                <a href="{{ route('students.edit', $students->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                <form action="{{ route('students.destroy', $students->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('POST')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
    </tbody> -->
    <tr>
        <th>Student Name:</th>
        <td>{{$students->name}}</td>
    </tr>
    <tr>
        <th>Class:</th>
        <td>{{$students->class}}</td>
    </tr>
    <tr>
        <th>Roll Number:</th>
        <td>{{$students->roll_number}}</td>
    </tr>
    <tr>
        <th>Images:</th>
        <td></td>
    </tr>
  </table>
  <div class="row">
    @foreach($students->images as $image)
        <div class="col-md-6 my-4">
        <img src="/images/{{ $image ? $image->image:"" }}" height="250px" width="450px">
        </div>
        @endforeach
    </div>
    
    </div>
    
    
    
@endsection