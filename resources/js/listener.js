const guessResult = document.getElementById('guess-result');
const readyButton = document.getElementById('ready-button');
const readyText = document.getElementById('ready-text');
const readyCard = document.getElementById('ready-card');
const gameCard = document.getElementById('game-card');
const resultsCard = document.getElementById('results-card');
const resultText = document.getElementById('result-text');
const resultImage = document.getElementById('result-image');
const minNumberOfPlayers = 2;
let numberOfActivePlayers = 0;

if (readyButton) {
    readyButton.addEventListener('click', (e) => {
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

const showResult = (e) => {
    if (e.userID == sessionStorage.getItem('user_id')) {
        if (e.winner) { //you sent the message and you were correct
            closeGame('You win', 'correct-result', true);
        } else { //you sent the message and it was not correct .. guess again
            guessResult.classList.add('wrong-result');
            guessResult.innerHTML = e.message;
        }
    } else if (e.winner) { // some one else won.
        closeGame('You Lose', 'wrong-result');

    }
}

const getReady = () => {
    readyButton.hidden = true;
    readyText.hidden = false;
}

const startGame = (numberOfActivePlayers) => {
    console.log(numberOfActivePlayers);
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
    resultImage.hidden = !celebrate;
}

