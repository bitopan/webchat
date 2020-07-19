<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Your Personal Conferrence Room</title>

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
        body{background:#000;margin:0px;overflow: hidden}
    </style>
</head>
<body>
    <div style="position: fixed;width:100%;left:0px;top:0px;z-index:99;display: none">
        <div class="error" style="color:#fff"></div>
        <div style="color:#fff;font-family: Nunito;font-size:25px;float:left;text-align:left;padding:10px" align="left">Geek Meet<div style="font-size:12px">Your Personal Conferrence Room</div></div>
        <div class="fullscreen" style="curspor::pointer;padding:5px;border-radius:7px;background:#000;float:right;margin:5px">
            <svg width="30" height="30" viewBox="0 0 16 16" class="bi bi-arrows-fullscreen" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M1.464 10.536a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3.5a.5.5 0 0 1-.5-.5v-3.5a.5.5 0 0 1 .5-.5z"/>
              <path fill-rule="evenodd" d="M5.964 10a.5.5 0 0 1 0 .707l-4.146 4.147a.5.5 0 0 1-.707-.708L5.257 10a.5.5 0 0 1 .707 0zm8.854-8.854a.5.5 0 0 1 0 .708L10.672 6a.5.5 0 0 1-.708-.707l4.147-4.147a.5.5 0 0 1 .707 0z"/>
              <path fill-rule="evenodd" d="M10.5 1.5A.5.5 0 0 1 11 1h3.5a.5.5 0 0 1 .5.5V5a.5.5 0 0 1-1 0V2h-3a.5.5 0 0 1-.5-.5zm4 9a.5.5 0 0 0-.5.5v3h-3a.5.5 0 0 0 0 1h3.5a.5.5 0 0 0 .5-.5V11a.5.5 0 0 0-.5-.5z"/>
              <path fill-rule="evenodd" d="M10 9.964a.5.5 0 0 0 0 .708l4.146 4.146a.5.5 0 0 0 .708-.707l-4.147-4.147a.5.5 0 0 0-.707 0zM1.182 1.146a.5.5 0 0 0 0 .708L5.328 6a.5.5 0 0 0 .708-.707L1.889 1.146a.5.5 0 0 0-.707 0z"/>
              <path fill-rule="evenodd" d="M5.5 1.5A.5.5 0 0 0 5 1H1.5a.5.5 0 0 0-.5.5V5a.5.5 0 0 0 1 0V2h3a.5.5 0 0 0 .5-.5z"/>
            </svg>
        </div>

    </div>

    <div id="meet" style="background:#000 url('loader.svg') center center no-repeat;width:100vw;height:100vh"></div>

    <script>
        function addVideoSession(roomName, userName){
            $('#meet').html('');

            const domain = 'webchat.geekworkx.net';
            const options = {
                DEFAULT_BACKGROUND: '#000000',
                roomName: roomName,
                width: '100%',
                height: '100%',
                interfaceConfigOverwrite: {
                   MOBILE_APP_PROMO: false,
                },
                parentNode: document.querySelector('#meet'),
                userInfo: {
                    displayName: userName
                },
                noSsl: true,
                DEFAULT_REMOTE_DISPLAY_NAME: 'A New Mate',
                DEFAULT_LOCAL_DISPLAY_NAME: 'me',
                SHOW_JITSI_WATERMARK: false,
                JITSI_WATERMARK_LINK: 'https://geekworkx.com',
                DISABLE_JOIN_LEAVE_NOTIFICATIONS: false,
                ENFORCE_NOTIFICATION_AUTO_DISMISS_TIMEOUT: 10,
                SHOW_POWERED_BY: true,
                APP_NAME: 'GeekMeet',
                NATIVE_APP_NAME: 'GeekMeet',
                PROVIDER_NAME: 'Geekworkx Technologies',
               
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
            addVideoSession(`{{ $data['room'] }}`, `{{ $data['username'] }}`);
        });

    </script>
    <script src='https://webchat.geekworkx.net/external_api.js'></script>
    <script>
        $(document).ready(function (){
            $("#jitsiConferenceFrame0").removeAttr("style");
            if(navigator.platform == "android"){
                $("#jitsiConferenceFrame0").attr("style","width:100vw;height:100vh;border:0px;");
            }
            else if(navigator.platform == "iPhone"){
                $("#jitsiConferenceFrame0").attr("style","width:100vw;height:90vh;border:0px;");
            }
            else{
                $("#jitsiConferenceFrame0").attr("style","width:100vw;height:100vh;border:0px;");
            }
        });



var button = document.querySelector('.fullscreen');
button.addEventListener('click', fullscreen);
// when you are in fullscreen, ESC and F11 may not be trigger by keydown listener. 
// so don't use it to detect exit fullscreen
document.addEventListener('keydown', function (e) {
  console.log('key press' + e.keyCode);
});
// detect enter or exit fullscreen mode
document.addEventListener('webkitfullscreenchange', fullscreenChange);
document.addEventListener('mozfullscreenchange', fullscreenChange);
document.addEventListener('fullscreenchange', fullscreenChange);
document.addEventListener('MSFullscreenChange', fullscreenChange);

function fullscreen() {
  // check if fullscreen mode is available
  if (document.fullscreenEnabled || 
    document.webkitFullscreenEnabled || 
    document.mozFullScreenEnabled ||
    document.msFullscreenEnabled) {
    
    // which element will be fullscreen
    var iframe = document.querySelector('iframe');
    // Do fullscreen
    if (iframe.requestFullscreen) {
      iframe.requestFullscreen();
    } else if (iframe.webkitRequestFullscreen) {
      iframe.webkitRequestFullscreen();
    } else if (iframe.mozRequestFullScreen) {
      iframe.mozRequestFullScreen();
    } else if (iframe.msRequestFullscreen) {
      iframe.msRequestFullscreen();
    }
  }
  else {
    document.querySelector('.error').innerHTML = 'Your browser is not supported';
  }
}

function fullscreenChange() {
  if (document.fullscreenEnabled ||
       document.webkitIsFullScreen || 
       document.mozFullScreen ||
       document.msFullscreenElement) {
    console.log('enter fullscreen');
  }
  else {
    console.log('exit fullscreen');
  }
  // force to reload iframe once to prevent the iframe source didn't care about trying to resize the window
  // comment this line and you will see
  var iframe = document.querySelector('iframe');
  iframe.src = iframe.src;
}
    </script>

</body>
</html>