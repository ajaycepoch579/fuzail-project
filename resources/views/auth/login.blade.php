@extends('auth.layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="container-fluid">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Login</h2>
            </div>
        </div>
    </div>
<div class="card push-top">
    <div class="card-header">
        Login
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
<form  action="{{ route('login') }}"  method="post">
    @csrf
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email"  />
    </div>
    <!-- Password -->
    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password"  />
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-block btn-success">Login</button>
</form>
</div>
</div>
</div>
@endsection
