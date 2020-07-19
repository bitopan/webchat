@extends('layouts.iframe')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Join Meeting</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <form method="post" action="/meeting">

            {{ csrf_field() }}

            <table class="table">
                <tr>
                    <td>
                        
                        <div class="form-group">
                            <label for="meeting_id">Meeting ID</label>
                            <input type="text" name="meeting_id" class="form-control" id="meeting_id" aria-describedby="meetingHelp" placeholder="Enter meeting ID" value="{{ (isset($meeting)) ? $meeting : '' }}">

                        </div>
                        <div class="form-group">
                            <label for="meeting_password">Password</label>
                            <input type="text" name="meeting_password" class="form-control" id="meeting_password" aria-describedby="passwordHelp" placeholder="Enter Password" value="{{ (isset($password)) ? $password : '' }}">

                        </div>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter your name" value="">

                        </div>
                        

                    </td>
                    
                </tr>
                <tr>
                    <td align="center">
                        <button type="submit" class="btn btn-primary">Join</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    @if (session('url'))
        <div  id="details">
            <div>
                <b>URL:</b> {{ session('url') }}
            </div>
            <div>
                <b>Meeting ID:</b> {{ session('meeting_id') }}
            </div>
            <div>
                <b>Password:</b> {{ session('password') }}
            </div>
        
        </div>
            <div>
                <b>Creator Code:</b> {{ session('creator_code') }} <small style="color: red">Do not share this code to participants.</small>
            </div>

        <div>
            <button type="button" class="btn btn-primary" name="copy" onclick="copyText()">Copy to Clipboard</button>
        </div>

        <script type="text/javascript">
            function copyText(){
                var containerid = 'details';
                if (document.selection) {
                    var range = document.body.createTextRange();
                    range.moveToElementText(document.getElementById(containerid));
                    range.select().createTextRange();
                    document.execCommand("copy");
                  } else if (window.getSelection) {
                    var range = document.createRange();
                    range.selectNode(document.getElementById(containerid));
                    window.getSelection().addRange(range);
                    document.execCommand("copy");
                    alert("Text has been copied.")
                  }
            
            }
        </script>
    @endif

</div>

@endsection
