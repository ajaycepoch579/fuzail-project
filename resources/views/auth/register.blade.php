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
                <h2>Register</h2>
            </div>
        </div>
    </div>
<div class="card push-top">
    <div class="card-header">
        Register
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
<form  action="{{ route('register') }}"  method="post">
    @csrf
    <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" id="name"  />
    </div>
    <!-- Password -->
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email"  />
    </div>

    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password"  />
    </div>

    <div class="form-group">
    <label for="password_confirmation">Confirm password</label>
    <input type="password" name="password_confirmation" class="form-control"  id="password_confirmation" />
    </div>
    
    <button type="submit" class="btn btn-block btn-primary">Register</button>
</form>
</div>
</div>
</div>
@endsection
