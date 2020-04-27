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
                <div>
                    <div class="row">
                        <div class="col-md-9 h5">My Rooms</div>
                        <div class="col-md-3 h5 text-right">
                            <a href="javascript:void(0)" onclick="createRoom()"><i class="fa fa-plus" alt="Create Room"></i></a>
                        </div>
                    </div>
                    
                    <ul class="list-group" id="rooms-list">
                        
                    </ul>
                <div>
                    
                <div>
                    <div class="h5">Join Meeting</div>
                    <div>
                        <form class="form-inline" action="/join-room" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group mx-sm-3 mb-2" style="margin-left:0 !important">
                                <label for="inputPassword2" class="sr-only">Room ID</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Room ID" style="max-width: 90px">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Join</button>
                        </form>
                    </div>
                </div>

                <div>
                    <div class="h5">Users List<div class="h3">
                    <ul class="list-group" id="users-list">
                        
                    </ul>
                </div>
            </div>
        </div>
    {{-- </div> --}}
</div>

<script>

    function createRoom() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '/create-room',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (data) {
                let li= "";
                //$.each(data, function(index, room){
                    li += '<li class="list-group-item h6 pointer" onclick="addVideoSession(\''+data['name']+'\')">' + data['name'].replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '</li>';
                //});

                $("#rooms-list").prepend(li);
            }

        });
    }

    function getUserRooms() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/myrooms/{{ Auth::user()->id }}',

            success: function (data) {
                let li= "";
                $.each(data, function(index, room){
                    li += '<li class="list-group-item h6 pointer" onclick="addVideoSession(\''+room['name']+'\')">' + room['name'].replace(/\B(?=(\d{3})+(?!\d))/g, " "); + '</li>';
                });

                $("#rooms-list").html(li);
            }

        });
    }


    function addVideoSession(roomName){
        $('#meet').html('');
        const domain = 'webchat.geekworkx.net';
        const options = {
            roomName: roomName,
            width: 900,
            height: 500,
            parentNode: document.querySelector('#meet'),
            userInfo: {
                email: '{{ Auth::user()->email }}',
                displayName: '{{ Auth::user()->name }}'
            },
            jwt: '{{ create_jwt(Auth::user()) }}',
            noSsl: true,
            
        };
        const api = new JitsiMeetExternalAPI(domain, options);
        api.executeCommand('subject', ' ');
        api.on('readyToClose', () => {
            api.dispose();
        });
    }

    function checkActiveUsers(){
        $.ajax({
        type: "GET",
        dataType: "json",
        url: '/users-with-status',
        success: function(data){
            //console.log(data);
            let li = "";
            let status = "";
            $.each(data, function(index, user){
                //console.log(user)
                if(user['status'] == true){
                    status = '<span style="height: 10px; width: 10px; background-color: green; border-radius: 50%; display: inline-block;"></span> ';
                }else{
                    status = '<span style="height: 10px; width: 10px; background-color: #bbb; border-radius: 50%; display: inline-block;"></span> ';
                }
                    
                
                li += '<li class="list-group-item h6">' + status + user['name'] + '</li>';
            })
            
            $("#users-list").html(li);
        }, 

        complete: function (params) {
            console.log("complete");
            getUserRooms();
        }
    });
    };

    $(document).ready(function(){
        checkActiveUsers();
        setInterval(checkActiveUsers,30000);
    });

</script>

@endsection
