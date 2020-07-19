@extends('layouts.iframe')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Create Meeting</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <form method="post" action="/meeting">

            {{ csrf_field() }}

            <input type="hidden" name="create" value="1">

            <table class="table">
                <tr>
                    <td>
                        
                        <div class="form-group">
                            <label for="meeting_id">Meeting ID</label>
                            <input type="text" name="meeting_id" class="form-control" id="meeting_id" aria-describedby="meetingHelp" placeholder="Enter meeting ID" value="{{ $data['room'] }}">

                        </div>
                        <div class="form-group">
                            <label for="meeting_password">Password</label>
                            <input type="text" name="meeting_password" class="form-control" id="meeting_password" aria-describedby="passwordHelp" placeholder="Enter Password" value="{{ $data['password'] }}">

                        </div>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter your name" value="">

                        </div>
                        

                    </td>
                    
                </tr>
                <tr>
                    <td align="center">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

@endsection
