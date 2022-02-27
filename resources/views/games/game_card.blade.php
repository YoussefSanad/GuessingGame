<div class="game-card center">
    <div class="game-content">
        <form action="/api/games/{{$activeGame->id}}/guess" class="game-form">
            <input type="number" step="1" min="1" max="100" validate class="guessing-input">

            <input type="submit" class="submit" value="Guess Number">
        </form>
    </div>

    <div id="result" >

    </div>
</div>
