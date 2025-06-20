<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamClone - Start or Join Live Stream</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #00d4ff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .input-group {
            margin: 1rem 0;
        }
        input[type="text"], button {
            padding: 0.75rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            width: 70%;
            max-width: 300px;
        }
        input[type="text"] {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
        }
        button {
            background: #00d4ff;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #00b4d8;
        }
        @media (max-width: 480px) {
            h1 { font-size: 1.8rem; }
            input[type="text"], button { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>StreamClone</h1>
        <div class="input-group">
            <input type="text" id="roomId" placeholder="Enter Room ID or Create New">
            <button onclick="redirectToStream()">Start/Join Stream</button>
        </div>
    </div>

    <script>
        function redirectToStream() {
            const roomId = document.getElementById('roomId').value.trim();
            if (roomId) {
                window.location.href = `stream.php?room=${roomId}`;
            } else {
                const newRoomId = 'ROOM_' + Math.random().toString(36).substr(2, 9);
                window.location.href = `stream.php?room=${newRoomId}`;
            }
        }
    </script>
</body>
</html>
