<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('/css/game.css') }}" rel="stylesheet" type="text/css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>BlackJack</title>
</head>
<body>
<div class="wrapper">
    <div class="game">
        <div id="alert" class="alert alert-error hide"><span></span></div>
        @if(isset($dealer) && isset($player))
            <div class="dealer">
                @php($count = 1)
                <div class="dhand">
                    @foreach($dealer->getHand() as $dealerCard)
                        @if($player->playerMove())
                            <img class="card"
                                 src="/img/{{ $count !== count($dealer->getHand()) ? 'semFace.png' : (string) $dealerCard . '.png' }}">
                        @elseif(!$player->playerMove())
                            <img class="card" src="/img/{{(string) $dealerCard . '.png' }}">
                        @endif
                        @php($count++)
                    @endforeach
                </div>

            </div>
            <div class="player">
                <div class="phand">
                    @foreach($player->getHand() as $playerCard)
                        <img class="card" src="/img/{{(string) $playerCard . '.png' }}">
                    @endforeach
                </div>
            </div>
        @endif

        <div id="money">
            <span id="cash">Cash: $<span></span></span>
            <div id="bank">Winnings: $<span></span></div>
        </div>
    </div>
    <div class="actions">
        <a href="/deal/{{isset($deck) ? $deck->id() : ''}}" class="deal deal">Deal!</a>
        <form method="post" action="/stand">
            @csrf
            <button type="submit" class="hit btn" disabled>Hit</button>
        </form>
        <button class="stand btn" disabled>Stand</button>
        <button class="double btn" disabled>Double Down</button>
        <button class="split btn" disabled>Split</button>
        <button class="insurance btn" disabled>Insurance</button>
        <strong>Wager:</strong> $<input class="wager" class="input-small" type="text"/>
    </div>
</div>
<div id="myModal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Out of cash!</h3>
    </div>
    <div class="modal-body">
        <p>You ran out of cash, but you spot an ATM nearby. Would you like to withdraw another $1,000 and try your luck
            again?</p>
    </div>
    <div class="modal-footer">
        <a href="#" id="cancel" class="btn">Nah</a>
        <a href="#" id="newGame" class="btn btn-primary">Yes!</a>
    </div>
</div>
</body>
<script>

</script>
</html>
