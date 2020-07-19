<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>


    <style>
        a[href], input[type='submit'], input[type='image'], label[for], select, button, .pointer {
            cursor: pointer;
        }
        .hr-primary{
        background-image: -webkit-linear-gradient(left, rgba(66,133,244,.8), rgba(66, 133, 244,.6), rgba(0,0,0,0));
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-4">

            <div class="container">
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
            </div>
        </main>
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
                api.executeCommand('password', '{{ $data['password'] }}');
            }, 10000);


            api.on('readyToClose', () => {
                api.dispose();
            });
        }

        $(document).ready(function (){
            addVideoSession(`{{ $data['room'] }}`, `'{{ $data['username'] }}'`);
        });

    </script>
    <script src='https://webchat.geekworkx.net/external_api.js'></script>

</body>
</html>