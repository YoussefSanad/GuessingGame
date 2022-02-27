const baseUrl = window.location.origin;
const guessResult = document.getElementById('guess-result');

let forms = Array.from(document.getElementsByClassName('game-form'));

forms.forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        clearResult();
        sessionStorage.setItem('user_id', form.getAttribute('data-user-id'))
        contactApi(form);
    });
});


const contactApi = form => {
    let url = form.getAttribute('action');
    let endpoint = `${baseUrl}${url}`;
    let input = form.getElementsByClassName('guessing-input')[0];
    axios.post(endpoint, {guess: input.value})
        .catch(error => {
            console.log(error);
            guessResult.innerHTML = "Something went wrong";
        });
}

const clearResult = () => {
    guessResult.innerHTML = 'Guessing....';
    guessResult.classList.remove('wrong-result');
}
