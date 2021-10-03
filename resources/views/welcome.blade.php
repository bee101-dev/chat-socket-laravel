<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat App Socket.io</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous">
        <style>
            .chat-row{
                margin: 50px;
            }
            ul{
                margin:0;
                padding:0;
                list-style: none;
            }

            ul li {
                padding: 8px;
                background: #79b4e4;
                margin-bottom: 20px;
            }

            ul li:nth-child(2n-2){
                background: #e78a4b;
            }

            .chat-input{
                border: 1px solid lightblue;
                border-radius: 10px;
                padding: 8px 10px;
            }
        </style>
    </head>
    <body >
       
        <div class="container">
            <div class="row chat-row">
                <div class="chat-content col">
                    <ul>
                       
                    </ul>
                </div>
            </div>

            <div class="row chat-row">
                <div class="chat-section col">
                    <div class="chat-box">
                        <div id="chatInput" class="chat-input bg-white" contenteditable="">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.2.0/socket.io.min.js" integrity="sha384-PiBR5S00EtOj2Lto9Uu81cmoyZqR57XcOna1oAuVuIEjzj0wpqDVfD0JA9eXlRsj" crossorigin="anonymous"></script>
    
        <script>
            $(function() {
                let ip_address = '127.0.0.1';
                let socket_port = '3000';
                let socket = io(ip_address + ':' + socket_port);

                let chatInput = $('#chatInput');

                chatInput.keypress(function(event){
                    let message = $(this).html();
                    // console.log(message);
                    if(event.which === 13 && !event.shiftKey){
                        socket.emit('sendChatToServer', message);
                        chatInput.html('');
                        return false;
                    }
                });

                socket.on('sendChatToClient', (message) => {
                    $('.chat-content ul').append(`<li>${message}</li>`);
                });
            })
        </script>
    </body>
</html>
