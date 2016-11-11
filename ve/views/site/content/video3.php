<!DOCTYPE html>
<html>
   <head>
      <title>Twilio Video</title>
  <script type="text/javascript" src="//media.twiliocdn.com/sdk/conversations/v0.7/js/releases/0.7.3.b1-951e4ed/twilio-conversations.min.js"></script>

      <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
      <link href="http://skills-video.herokuapp.com/video.css" type="text/css" rel="stylesheet" />
   </head>
   <body>
      <div id="call-controls">
         <button class="call" id="call">Call</button>
         <button class="hangup" id="hangup">Hangup</button>
         <input type="text"  id="remote-address-name"  name="number" placeholder="Enter a participant to call"/>
      </div>
      <div id="conversation">
         <div id="remote" align="center">
            <div id="remote-video"><img src="http://placehold.it/360x270s&text=Remote+Video"  width="100%"></div>
            <p id="remote-video-label" class="video-label">participant video</p>
         </div>
         <div id="local" align="center">
            <div id="local-video"><img src="http://placehold.it/360x270s&text=Your+Video" width="100%"></div>
            <p id="local-video-label" class="video-label">your video (<a id="preview" href="#">preview</a>)</p>
         </div>
      </div>
      </div>
      <br style="clear:both;">
      <div id="log">Loading...</div>
      <script charset="utf-8">
         var token='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImN0eSI6InR3aWxpby1mcGE7dj0xIn0.eyJqdGkiOiJTSzE5ZGVjMjYyOWNmMjRlZmQ4ZDJiM2Q5NzUyMzJlNTAyLTE0NzI4MzU0ODYiLCJpc3MiOiJTSzE5ZGVjMjYyOWNmMjRlZmQ4ZDJiM2Q5NzUyMzJlNTAyIiwic3ViIjoiQUMxM2RmYTVjYmVmMzgwNTI3YzA4MzQzYzRlMzFkZTI1MyIsImV4cCI6MTQ3MjgzOTA4NiwiZ3JhbnRzIjp7ImlkZW50aXR5Ijoib3BlcmF0b3IiLCJydGMiOnsiY29uZmlndXJhdGlvbl9wcm9maWxlX3NpZCI6IlZTNjk3NjBlZTgwN2ZkODJlNjI2MjlkOWFmMjg5MjliZDgifX19.0GsEtnJ5_DPVjxi4VE0l96-twkxkWUf8YnlnPhCUsOU';
      </script>
      <script src="/js/livevideo2.js"></script>
   </body>
</html>
<?php
exit;