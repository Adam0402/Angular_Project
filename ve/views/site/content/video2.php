<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="author" type="text/html" href="https://plus.google.com/+MuazKhan">
    <meta name="author" content="Muaz Khan">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <link rel="stylesheet" href="https://cdn.webrtc-experiment.com/style.css">
  
  <script src="https://media.twiliocdn.com/sdk/js/common/v0.1/twilio-common.min.js"></script>
  <script src="https://media.twiliocdn.com/sdk/js/conversations/v0.13/twilio-conversations.min.js"></script>

    <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://cdn.webrtc-experiment.com/gif-recorder.js"></script>
    <script src="https://cdn.webrtc-experiment.com/getScreenId.js"></script>

    <!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
    <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script>
        
  <script src="/js/livevideo.js"></script>

    <style>
    audio {
        vertical-align: bottom;
        width: 10em;
    }
    video {
        max-width: 100%;
        vertical-align: top;
    }
    input {
        border: 1px solid #d9d9d9;
        border-radius: 1px;
        font-size: 2em;
        margin: .2em;
        width: 30%;
    }
    p,
    .inner {
        padding: 1em;
    }
    li {
        border-bottom: 1px solid rgb(189, 189, 189);
        border-left: 1px solid rgb(189, 189, 189);
        padding: .5em;
    }
    label {
        display: inline-block;
        width: 8em;
    }
    </style>
    
    <style>
        .recordrtc button {
            font-size: inherit;
        }
        
        .recordrtc button, .recordrtc select {
            vertical-align: middle;
            line-height: 1;
            padding: 2px 5px;
            height: auto;
            font-size: inherit;
            margin: 0;
        }
        
        .recordrtc, .recordrtc .header {
            display: block;
            text-align: center;
            padding-top: 0;
        }
        
        .recordrtc video {
            width: 70%;
        }
        
        .recordrtc option[disabled] {
            display: none;
        }
    </style>
    
</head>

<body>
    <article>
        
        <section class="experiment recordrtc">
            <h2 class="header">
                <select class="recording-media">
                    <option value="record-video">Video</option>
                    <option value="record-audio">Audio</option>
                    <option value="record-screen">Screen</option>
                </select>
                
                into
                <select class="media-container-format">
                    <option>WebM</option>
                    <option disabled>Mp4</option>
                    <option disabled>WAV</option>
                    <option disabled>Ogg</option>
                    <option>Gif</option>
                </select>
                
                <button>Start Recording</button>
            </h2>
            
            <div style="text-align: center; display: none;">
                <button id="upload-to-server">Upload To Server</button>
            </div>
            
            <br>
            
            <div id="remote-media">
            <video id="remote-media2"></video>
            </div>
  
  <div id="local-media"></div>
  
  
  <div id="invite-controls">
      <button id="button-invite">Start</button>
      <button id="button-stop">Stop</button>
    </div>
    <div id="log">
      <p>&gt;&nbsp;<span id="log-content">Preparing to listen</span>...</p>
    </div>
        </section>
        

<script>
function successCallback(stream) {
    // RecordRTC usage goes here
}

function errorCallback(error) {
    // maybe another application is using the device
}

var mediaConstraints = { video: true, audio: true };

navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
</script>

        

</body>

</html>

<?php
exit;