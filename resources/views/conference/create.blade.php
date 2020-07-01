@extends('layouts.iframe')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Create Conference</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>


@endsection