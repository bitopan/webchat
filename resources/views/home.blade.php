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
                <h2>Users List<h2>
                <ul class="list-group" id="users-list">
                    
                </ul>
            </div>
        </div>
    {{-- </div> --}}
</div>

<script>

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
                    
                
                li += '<li class="list-group-item h6" onclick="addVideoSession()">' + status + user['name'] + '</li>';
            })
            
            $("#users-list").html(li);
        }, 

        complete: function (params) {
            console.log("complete")
        }
    });
    };

    $(document).ready(function(){
        checkActiveUsers();
        setInterval(checkActiveUsers,30000);
    });

</script>

@endsection
