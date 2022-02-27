Echo.channel('notification')
    .listen('MessageNotification', (e) => {
        if (e.winner) {

        } else {
            result.innerHTML = e.message;
            // result.classList.add('')
        }
    });
