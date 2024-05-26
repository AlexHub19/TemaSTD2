<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STD2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .chat-body {
            padding: 10px;
            overflow-y: auto;
            height: 300px;
        }

        .message {
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #e5e5ea;
        }

        .user-message {
            background-color: #007bff;
            color: #fff;
            text-align: right;
        }

        .bot-message {
            background-color: #28a745;
            color: #fff;
        }

        .chat-input {
            width: calc(100% - 20px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0 10px;
            box-sizing: border-box;
        }

        .send-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
<?php
    function connectToDatabase($servername, $username, $password, $database, $port = 3306) {
        $conn = new mysqli($servername, $username, $password, $database, $port);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    $servername = "mariadb"; 
    $username = "root";
    $password = "test";
    $database = "MessageAttributes";
    $port = 3306;

    $conn = connectToDatabase($servername, $username, $password, $database, $port);

    if(isset($_POST['user_input'])) {
        $user = "Alex";
        $content = $_POST['user_input'];
        $sql = "INSERT INTO MessageAttributes (User, Content) VALUES ('$user', '$content')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => $content]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
    }

    $conn->close();
?>

    <div class="chat-container">
        <div class="chat-header">
            ChatApp - Chatbot
        </div>
        <div class="chat-body" id="chat-body">
            <div class="message bot-message">Bun venit la ChatApp! Cum pot sa te ajut?</div>
        </div>
        <div class="chat-input-container">
            <input type="text" name="user_input" id="user-input" class="chat-input" placeholder="Scrie aici...">
            <button type="button" id="send-button" class="send-button">Trimite</button>
        </div>
    </div>

    <script>
        document.getElementById('send-button').addEventListener('click', function () {
            var userInput = document.getElementById('user-input').value;
            var chatBody = document.getElementById('chat-body');
            var userMessage = '<div class="message user-message">' + userInput + '</div>';
            chatBody.innerHTML += userMessage;
            chatBody.scrollTop = chatBody.scrollHeight;

            fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'user_input=' + encodeURIComponent(userInput)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    var botMessage = '<div class="message bot-message">Îmi pare rau, dar nu sunt un adevarat chatbot. Acesta este doar un exemplu de interfa?a. :)</div>';
                    chatBody.innerHTML += botMessage;
                    chatBody.scrollTop = chatBody.scrollHeight;
                } else {
                    alert('Error: ' + data.message);
                }
            });

            document.getElementById('user-input').value = '';
        });
    </script>
</body>
</html>
