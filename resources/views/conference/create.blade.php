@extends('layouts.iframe')

@section('content')

@if(session('message'))

<div class="alert alert-success" style="font-weight: bold; font-family: arial; font-size: 18px; margin-top: 20px; padding: 10px" align="center">
    {{ session('message') }}
</div>

@endif

@isset($data)

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Create Conference</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <form method="post" action="/conference-create">

            {{ csrf_field() }}
            <input type="hidden" name="room" value="{{ $data['room'] }}">
            <input type="hidden" name="password" value="{{ $data['password'] }}">

            <table class="table">
                <tr>
                    <td>
                        
                        <div class="form-group">
                            <label for="doctor_name">Doctor Name</label>
                            <input type="text" name="doctor_name" class="form-control" id="doctor_name" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data['doctor_name'] }}">

                        </div>
                        <div class="form-group">
                            <label for="doctor_email">Doctor Email address</label>
                            <input type="email" name="doctor_email" class="form-control" id="doctor_email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data['doctor_email'] }}">

                        </div>
                        <div class="form-group">
                            <label for="doctor_phone">Doctor Phone</label>
                            <input type="text" name="doctor_phone" class="form-control" id="doctor_phone" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data['doctor_phone'] }}">

                        </div>
                    </td>
                    <td>
                            
                        <div class="form-group">
                            <label for="patient_name">Patient Name</label>
                            <input type="text" name="patient_name" class="form-control" id="patient_name" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data['patient_name'] }}">

                        </div>
                        <div class="form-group">
                            <label for="patient_email">Patient Email address</label>
                            <input type="email" name="patient_email" class="form-control" id="patient_email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data['patient_email'] }}">

                        </div>
                        <div class="form-group">
                            <label for="patient_phone">Patient Phone</label>
                            <input type="text" name="patient_phone" class="form-control" id="patient_phone" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data['patient_phone'] }}">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endisset

@endsection
