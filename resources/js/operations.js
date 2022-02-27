const baseUrl = window.location.origin;

let forms = Array.from(document.getElementsByClassName('game-form'));

forms.forEach((form) => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        result.innerHTML = '';
        sessionStorage.setItem('user_id', form.getAttribute('data-user-id'))
        contactApi(form);
    });
});


const contactApi = form => {
    let url = form.getAttribute('action');
    let endpoint = `${baseUrl}${url}`;
    let input = form.getElementsByClassName('guessing-input')[0];
    axios.post(endpoint, {guess: input.value})
        .then(response => {
            console.log(response.data);
        })
        .catch(error => {
            console.log(error);
            result.innerHTML = "Something went wrong";
        });
}
