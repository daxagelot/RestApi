@extends('jpanel.layouts.app')

@section('title', 'Chat')

@section('styles')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/twemoji-awesome/dist/twemoji-awesome.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/avatarify/dist/avatarify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

<!-- Emoji Mart CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emoji-mart/css/emoji-mart.css" />

<style>
    /* WhatsApp-like chat styles */
    .chat-container {
        overflow-y: auto;
        height: 80vh; /* Adjust height as needed */
    }

    .message {
        max-width: 80%;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 10px;
        clear: both;
    }

    .sent {
        background-color: #dcf8c6; /* Light green for sent messages */
        float: right;
        text-align: right;
    }

    .sent .message-content {
        display: inline-block;
        background-color: #dcf8c6;
        padding: 10px;
        border-radius: 10px;
        font-size: 16px;
    }

    .received {
        background-color: #fff; /* White for received messages */
        float: left;
        text-align: left;
    }

    .received .message-content {
        display: inline-block;
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        font-size: 16px;
    }

    .input-msg {
        width: calc(100% - 55px);
        border-radius: 30px;
        padding: 10px 15px;
        border: 1px solid #ccc;
    }

    .input-msg:focus {
        outline: none;
        border-color: #007bff;
    }

    .emoji-picker {
        position: absolute;
        bottom: 100px;
        right: 10px;
        display: none;
    }

    .emoji-picker.show {
        display: block;
    }

    #send-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #send-btn:hover {
        background-color: #0056b3;
    }

    .message-input-container {
        position: relative;
        padding: 15px;
        background-color: #f0f0f0;
        border-top: 1px solid #ccc;
    }

    .emoji-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Chat
                    <span class="float-right"><a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a></span>
                </div>

                <div class="card-body" id="chat">
                    <div class="marvel-device nexus5">
                        <div class="top-bar"></div>
                        <div class="sleep"></div>
                        <div class="volume"></div>
                        <div class="camera"></div>
                        <div class="screen">
                            <div class="screen-container">
                                <div class="status-bar">
                                    <div class="time"></div>
                                    <div class="battery">
                                        <i class="zmdi zmdi-battery"></i>
                                    </div>
                                    <div class="network">
                                        <i class="zmdi zmdi-network"></i>
                                    </div>
                                    <div class="wifi">
                                        <i class="zmdi zmdi-wifi-alt-2"></i>
                                    </div>
                                    <div class="star">
                                        <i class="zmdi zmdi-star"></i>
                                    </div>
                                </div>
                                <div class="chat">
                                    <div class="chat-container" id="message-list">
                                        @foreach($chats as $chat)
                                            <div class="message @if($chat->sender_id == auth()->user()->id) sent @else received @endif">
                                                <div class="message-content">{!! $chat->content !!}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="message-input-container">
                                        <input id="message-input" class="input-msg" name="input" placeholder="Type a message" autocomplete="off" autofocus>
                                        <button class="emoji-btn" type="button">😊</button>
                                        <button id="send-btn" type="button"><i class="zmdi zmdi-mail-send"></i></button>
                                        <div class="emoji-picker"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Link to any necessary JavaScript libraries or scripts -->
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Emoji Mart JS -->
<script src="https://cdn.jsdelivr.net/npm/emoji-mart"></script>

<script>
    $(document).ready(function() {
        $('#send-btn').on('click', function() {
            sendMessage();
        });

        $('#message-input').on('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        $('.emoji-btn').on('click', function() {
            alert('hello');
            $('.emoji-picker').toggleClass('show');
        });

        const picker = new EmojiMart.Picker({
            // Customize options if needed
        });
        $('.emoji-picker').append(picker.render());
        picker.pickerVisible = true; // Show picker by default
    });

    function sendMessage() {
        var messageInput = $('#message-input').val().trim();
        if (messageInput !== '') {
            $('#message-list').append('<div class="message sent"><div class="message-content">' + messageInput + '</div></div>');
            $('#message-input').val(''); // Clear the input field after sending
        }
    }
</script>
@endsection
