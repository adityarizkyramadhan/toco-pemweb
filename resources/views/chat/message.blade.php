<!DOCTYPE html>
<html>

<head>
    <title>Chat Interface</title>
    <style>
        .chatbox {
            width: 400px;
            height: 300px;
            border: 1px solid #ccc;
            overflow: auto;
        }

        .input-box {
            margin-top: 10px;
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
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // pisahkan dari array json dimana user = user dan user = bot

                        renderChat("Bot : " + data.message);



                        // Clear input field
                        messageInput.value = "";
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    </script>
</body>

</html>
