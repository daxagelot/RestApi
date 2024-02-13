require('./bootstrap');

window.axios = require('axios');

document.getElementById('send-btn').addEventListener('click', function() {
    sendMessage();
});

document.getElementById('message-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

function sendMessage() {
    var messageInput = document.getElementById('message-input');
    var message = messageInput.value;
    if (message.trim() !== '') {
        axios.post('{{ route("chat.send-message") }}', { content: message })
            .then(function(response) {
                messageInput.value = '';
            })
            .catch(function(error) {
                console.error(error);
            });
    }
}

Echo.private('chat')
    .listen('NewMessage', (e) => {
        var messageList = document.getElementById('message-list');
        var li = document.createElement('li');
        li.textContent = e.message.content;
        messageList.appendChild(li);
    });
