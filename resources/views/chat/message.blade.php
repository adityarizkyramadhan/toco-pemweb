<!DOCTYPE html>
<html>

<head>
    <title>Chat Interface</title>
    <style>
        /* CSS untuk .chatbox */
        .chatbox {
            width: 400px;
            height: 300px;
            border: 1px solid #ccc;
            overflow: auto;
        }

        /* CSS untuk .input-box */
        .input-box {
            margin-top: 10px;
        }

        /* CSS untuk input[type="text"] */
        input[type="text"] {
            width: 300px;
            padding: 5px;
            border: 1px solid #ccc;
        }

        /* CSS untuk button */
        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="chatbox" id="chatbox">
        <!-- Chat messages will be displayed here -->
    </div>
    <div class="input-box">
        <input type="text" id="message" placeholder="Type your message..." />
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        function renderChat(message) {
            if (message.trim() !== "") {
                var chatbox = document.getElementById("chatbox");
                var newMessage = document.createElement("p");
                newMessage.innerText = message;

                // Insert new message at the end
                chatbox.appendChild(newMessage);

            }
        }

        function sendMessage() {
            var messageInput = document.getElementById("message");
            var message = messageInput.value;
            renderChat("User : " + message);
            messageInput.value = "";

            if (message.trim() !== "") {
                fetch('/send-message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    })
                    .then(response => {
                        console.log(response);
                        if (!response.ok) {
                            throw Error(response.statusText);
                        }
                        console.log(response);
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        // pisahkan dari array json dimana user = user dan user = bot
                        renderChat("Bot : " + data.message.content);
                        // Clear input field
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    </script>
</body>

</html>
