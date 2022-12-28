@extends('departments.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Department</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('departments.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="container-fluid mt-5">
    <div class="row">
        <div class="col">Department Name</div> 
        <div class="col">{{$departments->name;}}</div>       
    </div>
</div>
    
    
    
@endsection