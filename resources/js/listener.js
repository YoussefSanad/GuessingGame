const baseUrl = window.location.origin;

const readyButton = document.getElementById('ready-button');
const readyText = document.getElementById('ready-text');
const readyCard = document.getElementById('ready-card');

const gameCard = document.getElementById('game-card');
const guessResult = document.getElementById('guess-result');

const resultsCard = document.getElementById('results-card');
const resultText = document.getElementById('result-text');
const fireworksImage = document.getElementById('fireworks');
const betterLuckImage = document.getElementById('better-luck');

const minNumberOfPlayers = 3;
let numberOfActivePlayers = 0;

if (readyButton) {
    readyButton.addEventListener('click', (event) => {
            getReady();
            Echo.join(`notification`)
                .here((users) => {
                    numberOfActivePlayers = users.length;
                    startGame(numberOfActivePlayers);
                })
                .joining((user) => {
                    console.log(user.name + 'joined');
                    numberOfActivePlayers++;
                    startGame(numberOfActivePlayers);
                })
                .leaving((user) => {
                    console.log(user.name + ' left');
                    numberOfActivePlayers--;
                })
                .error((error) => {
                    console.error(error);
                }).listen('MessageNotification', (e) => showResult(e));
        }
    );
}

const showResult = (event) => {
    if (event.userID == sessionStorage.getItem('user_id')) {
        if (event.winner) { //you sent the message and you were correct
            closeGame('You win', 'correct-result', true);
        } else { //you sent the message and it was not correct .. guess again
            guessResult.classList.add('wrong-result');
            guessResult.innerHTML = event.message;
        }
    } else if (event.winner) { // some one else won.
        closeGame('You Lose', 'wrong-result');

    }
}

const getReady = () => {
    readyButton.hidden = true;
    readyText.hidden = false;
}

const startGame = (numberOfActivePlayers) => {
    if (numberOfActivePlayers >= minNumberOfPlayers) {
        readyCard.hidden = true;
        gameCard.hidden = false;
    }
}

const closeGame = (resultsText, resultClass, celebrate = false) => {
    gameCard.hidden = true;
    resultsCard.hidden = false;
    resultText.innerHTML = resultsText;
    resultText.classList.add(resultClass);
    if (celebrate) {
        fireworksImage.hidden = false;
    } else {
        betterLuckImage.hidden = false;
    }
}


