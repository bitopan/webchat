@extends('layouts.iframe')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Meeting Details</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        
        <div class="col-md-10">
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
                <div style="float: right;">
                    <form method="post" action="/meeting">

                        {{ csrf_field() }}
                        <input type="hidden" name="meeting_id" value="{{ session('meeting_id') }}">
                        <input type="hidden" name="meeting_password" value="{{ session('password') }}">
                        <input type="hidden" name="name" value="{{ session('username') }}">
                        <button type="submit" class="btn btn-info" >Join</button>
                    </form>
                </div>
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
    </div>

</div>

@endsection
