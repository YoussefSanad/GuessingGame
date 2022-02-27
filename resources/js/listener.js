const result = document.getElementById('result');
const readyButton = document.getElementById('ready-button');
const minNumberOfPlayers = 3;

if (readyButton)
{
    readyButton.addEventListener('click', listen);
}

const listen = () => {
    Echo.join(`notification`)
        .here((users) => {

            if (users.length >= minNumberOfPlayers) {
                startGame();
            }
        })
        .joining((user) => {
            console.log(user.name);
        })
        .leaving((user) => {
            console.log(user.name + ' left');
        })
        .error((error) => {
            console.error(error);
        }).listen('MessageNotification', (e) => showResult(e));
}

const showResult = (e) => {
    if (e.userID == sessionStorage.getItem('user_id')) {
        if (e.winner) { //you sent the message and you were correct
            result.classList.add('correct-result');
            result.innerHTML = e.message;
        } else { //you sent the message and it was not correct .. guess again
            result.classList.add('wrong-result');
            result.innerHTML = e.message;
        }
    } else if (e.winner) { // some one else wone.
        result.classList.add('wrong-result');
        result.innerHTML = 'Someone guessed the number before you!';
    }
}

