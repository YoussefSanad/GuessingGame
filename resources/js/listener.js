const result = document.getElementById('result');

Echo.channel('notification')
    .listen('MessageNotification', (e) => {
        if (e.userID == sessionStorage.getItem('user_id')) {
            if (e.winner) { //you sent the message and you were correct
                result.innerHTML = e.message;
            } else { //you sent the message and it was not correct .. guess again
                result.innerHTML = e.message;
            }
        } else if (e.winner) { // some one else wone.
            result.innerHTML = 'Someone guessed the number before you!';
        }

    });
