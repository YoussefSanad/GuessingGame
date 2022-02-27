<div class="main-card">

    <div class="header">
        <img class="user-image center" src="{{asset('img/unknown-user.png')}}" alt="User Image" height="50px" width="50px">
        <h1 class="title user-name">{{auth()->user()->name}}</h1>
    </div>

    <form action="/api/games/{{$activeGame->id}}/users/{{auth()->id()}}/guess" class="game-form"
          data-user-id="{{auth()->id()}}">
        <input type="number" step="1" min="1" max="100" validate required class="guessing-input center" placeholder="Guess a number..">

        <input type="submit" class="btn btn-primary" value="Guess Number">
    </form>
</div>

<div class="main-card">
    <div id="result" class="correct-result">
        Something for now
    </div>
</div>
