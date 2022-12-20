@extends('students.layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<!-- <div class="card push-top">
  <div class="card-header">
    Add User
  </div> -->
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Add Student</h2>
            </div>
            <div class="pull-right">
                <button><a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a><butoon>
            </div>
        </div>
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
      <form method="post" action="{{ route('students.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="class">Class</label>
              <input type="text" class="form-control" name="class"/>
          </div>
          <div class="form-group">
              <label for="roll_number">Roll Number</label>
              <input type="text" class="form-control" name="roll_number"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Submit</button>
      </form>
  </div>
</div>
@endsection