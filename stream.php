<?php
require_once 'db.php';
session_start();
$roomId = $_GET['room'] ?? 'default';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamClone - <?php echo htmlspecialchars($roomId); ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            overflow: hidden;
        }
        #video-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 1rem;
        }
        video {
            width: 300px;
            height: 200px;
            background: #000;
            margin: 0.5rem;
            border-radius: 10px;
        }
        #controls {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 10px;
        }
        button {
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            background: #00d4ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #00b4d8;
        }
        #chat-container {
            position: fixed;
            right: 1rem;
            top: 1rem;
            width: 300px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1rem;
        }
        #chat-messages {
            height: 80%;
            overflow-y: auto;
            border-bottom: 1px solid #fff;
        }
        #chat-input {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.5rem;
        }
        @media (max-width: 768px) {
            video { width: 200px; height: 150px; }
            #chat-container { width: 200px; height: 300px; }
        }
    </style>
</head>
<body>
    <div id="video-container"></div>
    <div id="controls">
        <button onclick="inviteGuest()">Invite Guest</button>
        <button onclick="startScreenShare()">Share Screen</button>
        <button onclick="startYouTubeStream()">Stream to YouTube</button>
    </div>
    <div id="chat-container">
        <div id="chat-messages"></div>
        <input type="text" id="chat-input" placeholder="Type a message...">
    </div>

    <script>
        // LiveKit API for Video Streaming
        const liveKitUrl = 'wss://your-livekit-server/live';
        const localVideo = document.createElement('video');
        localVideo.autoplay = true;
        navigator.mediaDevices.getUserMedia({ video: true, audio: true })
            .then(stream => {
                localVideo.srcObject = stream;
                document.getElementById('video-container').appendChild(localVideo);
            });

        // Jitsi Meet API for Guest Invitation
        function inviteGuest() {
            const jitsiUrl = `https://meet.jit.si/${$roomId}`;
            window.open(jitsiUrl, '_blank');
        }

        // WebRTC API for Screen Sharing
        function startScreenShare() {
            navigator.mediaDevices.getDisplayMedia({ video: true })
                .then(stream => {
                    const screenVideo = document.createElement('video');
                    screenVideo.srcObject = stream;
                    screenVideo.autoplay = true;
                    document.getElementById('video-container').appendChild(screenVideo);
                });
        }

        // YouTube Live API (Placeholder - Requires OAuth)
        function startYouTubeStream() {
            alert('YouTube Live streaming requires OAuth setup. Configure API key.');
        }

        // Socket.io for Live Chat
        const socket = new WebSocket('wss://your-socket-io-server');
        socket.onmessage = function(event) {
            document.getElementById('chat-messages').innerHTML += `<p>${event.data}</p>`;
        };
        document.getElementById('chat-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && this.value) {
                socket.send(this.value);
                this.value = '';
            }
        });
    </script>
</body>
</html>
