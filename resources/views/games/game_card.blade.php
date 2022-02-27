<div class="main-card" id="ready-card">
    <button class="btn btn-primary" id="ready-button">I'm Ready</button>

    <p class="sub-title" id="ready-text" hidden="true">Waiting for players to join...</p>
</div>

<div id="game-card" hidden>
    <div class="main-card">
        <div class="header">
            <img class="user-image center" src="{{asset('img/unknown-user.png')}}" alt="User Image" height="50px"
                 width="50px">
            <h1 class="title user-name">{{auth()->user()->name}}</h1>
        </div>

        <form action="/api/games/{{$activeGame->id}}/users/{{auth()->id()}}/guess" class="game-form"
              data-user-id="{{auth()->id()}}">
            <input type="number" step="1" min="1" max="100" validate required class="guessing-input center"
                   placeholder="Guess a number..">

            <input type="submit" class="btn btn-primary" value="Guess Number">
        </form>
    </div>

    <div class="main-card">
        <div id="guess-result">
            Start Guessing
        </div>
    </div>

</div>

<div class="main-card" id="results-card" hidden>
    <h1 class="title" id="result-text">You Win</h1>
    <img src="{{asset('img/fireworks.png')}}" class="results-image" alt="Fireworks" id="fireworks" hidden>
    <img src="{{asset('img/blnt.jpg')}}" class="results-image" alt="Better luck next time" id="better-luck" hidden>
    <a href="/" class="btn btn-primary" style="margin-top: 10px">Back to home</a>
</div>
