@extends('layouts.iframe')

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

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div id="meet"></div>
            </div>
        </div>
    {{-- </div> --}}
</div>

<script>

    function addVideoSession(roomName, userName){
        $('#meet').html('');

        const domain = 'webchat.geekworkx.net';
        const options = {
            roomName: roomName,
            width: 900,
            height: 500,
            parentNode: document.querySelector('#meet'),
            userInfo: {
                displayName: userName
            },
            jwt: '{{ create_jwt2($data) }}',
            noSsl: true,

        };

        const api = new JitsiMeetExternalAPI(domain, options);
        api.executeCommand('subject', '{{ $data['room'] }} ');


        setTimeout(() => {
            //alert();
            api.executeCommand('password', '{{ $data['password'] }}');
        }, 10000);

            // api.on('participantRoleChanged', () => {

            // alert('r');
            // });




        api.on('readyToClose', () => {
            api.dispose();
        });
    }



    $(document).ready(function (){
        addVideoSession(`{{ $data['room'] }}`, `'{{ $data['username'] }}'`);
    });

</script>
<script src='https://webchat.geekworkx.net/external_api.js'></script>
@endsection
