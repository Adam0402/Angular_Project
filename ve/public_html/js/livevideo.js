var conversationsClient;
var activeConversation;
var previewMedia;

// check for WebRTC
if (!navigator.webkitGetUserMedia && !navigator.mozGetUserMedia) {
  alert('WebRTC is not available in your browser.');
}

// generate an AccessToken in the Twilio Account Portal - https://www.twilio.com/user/account/video/testing-tools
var accessToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImN0eSI6InR3aWxpby1mcGE7dj0xIn0.eyJqdGkiOiJTSzE5ZGVjMjYyOWNmMjRlZmQ4ZDJiM2Q5NzUyMzJlNTAyLTE0NzI4MzU0ODYiLCJpc3MiOiJTSzE5ZGVjMjYyOWNmMjRlZmQ4ZDJiM2Q5NzUyMzJlNTAyIiwic3ViIjoiQUMxM2RmYTVjYmVmMzgwNTI3YzA4MzQzYzRlMzFkZTI1MyIsImV4cCI6MTQ3MjgzOTA4NiwiZ3JhbnRzIjp7ImlkZW50aXR5Ijoib3BlcmF0b3IiLCJydGMiOnsiY29uZmlndXJhdGlvbl9wcm9maWxlX3NpZCI6IlZTNjk3NjBlZTgwN2ZkODJlNjI2MjlkOWFmMjg5MjliZDgifX19.0GsEtnJ5_DPVjxi4VE0l96-twkxkWUf8YnlnPhCUsOU";

// use our AccessToken to generate an AccessManager object
var accessManager = new Twilio.AccessManager(accessToken);

// create a Conversations Client and connect to Twilio
conversationsClient = new Twilio.Conversations.Client(accessManager);
conversationsClient.listen().then(
  clientConnected,
  function (error) {
    log('Could not connect to Twilio: ' + error.message);
  }
);

// successfully connected!
function clientConnected() {
  document.getElementById('invite-controls').style.display = 'block';
  log("Connected to Twilio. Listening for incoming Invites as '" + conversationsClient.identity + "'");

  conversationsClient.on('invite', function (invite) {
    log('Incoming invite from: ' + invite.from);
    invite.accept().then(conversationStarted);
  });

  // bind button to create conversation
  document.getElementById('button-invite').onclick = function () {
    var inviteTo = 'steve';

    if (activeConversation) {
      // add a participant
      activeConversation.invite(inviteTo);
    } else {
        
      // create a conversation
      var options = {};
        /*
      if (previewMedia) {
        options.localMedia = previewMedia;
      }*/
      conversationsClient.inviteToConversation(inviteTo, options).then(
        conversationStarted,
        function (error) {
          log('Unable to create conversation');
          console.error('Unable to create conversation', error);
        }
      );
    }
  };
};

// conversation is live
function conversationStarted(conversation) {
  log('In an active Conversation');
  activeConversation = conversation;
  // draw local video, if not already previewing
  /*
  if (!previewMedia) {
    //conversation.localMedia.attach('#local-media');
  }*/
  // when a participant joins, draw their video on screen
  conversation.on('participantConnected', function (participant) {
    log("Participant '" + participant.identity + "' connected " + participant.sid);
    participant.media.attach('#remote-media');
  });
  // when a participant disconnects, note in log
  conversation.on('participantDisconnected', function (participant) {
    log("Participant '" + participant.identity + "' disconnected");
  });
  // when the conversation ends, stop capturing local video
  conversation.on('ended', function (conversation) {
    log("Connected to Twilio. Listening for incoming Invites as '" + conversationsClient.identity + "'");
    //conversation.localMedia.stop();
    conversation.disconnect();
    activeConversation = null;
  });
};


// activity log
function log(message) {
  document.getElementById('log-content').innerHTML = message;
};


var recordRTC;

function successCallback(stream) {
    // RecordRTC usage goes here
    log("success");
    var options = {
      mimeType: 'video/webm', // or video/mp4 or audio/ogg
      audioBitsPerSecond: 128000,
      videoBitsPerSecond: 128000,
      bitsPerSecond: 128000 // if this line is provided, skip above two
    };
    recordRTC = RecordRTC(stream, options);
    recordRTC.startRecording();
}

function errorCallback(error) {
    // maybe another application is using the device
}

var mediaConstraints = { video: true};

navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
window.onload = function(){ 
  document.getElementById('button-stop').onclick = function () {

    log("stop");
    participant.media.detach();
    
    var video = document.querySelector('video');
    
    recordRTC.stopRecording(function (audioVideoWebMURL) {
        video.src = audioVideoWebMURL;

        var recordedBlob = recordRTC.getBlob();
        recordRTC.getDataURL(function(dataURL) { });
    });
    
    return;
};
}