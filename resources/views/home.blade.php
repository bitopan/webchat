@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div> --}}

        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Video Chat</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <div id="meet"></div>
            </div>
            <div class="col-md-2">
                <h2>Video Chat<h2>
            </div>
        </div>
    {{-- </div> --}}
</div>
@endsection
