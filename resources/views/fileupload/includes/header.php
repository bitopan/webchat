<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Upload</title>
</head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >

<style>

    /*loader style*/
    #default-loader-div {
        position: fixed;
        top: 0;
        left:0;
        width: 100%;
        height:100%;
        background-color: #ccc;
        opacity: 0.5;
        z-index: 999999999999999!important;
    }
    #default-loader {
        position: fixed;
        top: 40%;
        left: 40%;
        width: 20%;
        height:20%;
        z-index: 999999999999999999!important;
    }

    input.hidden {
        position: absolute;
        left: -9999px;
    }

    .tital{ font-size:16px; font-weight:500;}
    .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}

</style>

<body>

<div id="default-loader-div" style="display:none;"></div>
<div id="default-loader" class="default-loader" style="display: none;">
    <svg class="lds-comets" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g transform="scale(-1,1) translate(-100,0)"><g transform="rotate(122.285 50 50)">
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" values="360 50 50;240 50 50;120 50 50;0 50 50" keyTimes="0;0.333;0.667;1" dur="2s" keySplines="0.7 0 0.3 1;0.7 0 0.3 1;0.7 0 0.3 1" calcMode="spline"></animateTransform>
                <path fill="#ef970c" d="M91,74.1C75.6,98,40.7,102.4,21.2,81c11,9.9,26.8,13.5,40.8,8.7c7.4-2.5,13.9-7.2,18.7-13.3 c1.8-2.3,3.5-7.6,6.7-8C90.5,67.9,92.7,71.5,91,74.1z"></path>
                <path fill="#035a70" d="M50.7,5c-4,0.2-4.9,5.9-1.1,7.3c1.8,0.6,4.1,0.1,5.9,0.3c2.1,0.1,4.3,0.5,6.4,0.9c5.8,1.4,11.3,4,16,7.8 C89.8,31.1,95.2,47,92,62c4.2-13.1,1.6-27.5-6.4-38.7c-3.4-4.7-7.8-8.7-12.7-11.7C66.6,7.8,58.2,4.6,50.7,5z"></path>
                <path fill="#31adf4" d="M30.9,13.4C12,22.7,2.1,44.2,7.6,64.8c0.8,3.2,3.8,14.9,9.3,10.5c2.4-2,1.1-4.4-0.2-6.6 c-1.7-3-3.1-6.2-4-9.5C10.6,51,11.1,41.9,14.4,34c4.7-11.5,14.1-19.7,25.8-23.8C37,11,33.9,11.9,30.9,13.4z"></path></g></g></svg>
</div>