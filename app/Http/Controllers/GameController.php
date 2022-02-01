<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Deck;
use App\Models\Player;
use App\Repositories\CardRepository;
use App\Repositories\DeckRepository;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private DeckRepository $deckRepository;
    private CardRepository $cardRepository;

    public function __construct(DeckRepository $deckRepository, CardRepository $cardRepository)
    {
        $this->deckRepository = $deckRepository;
        $this->cardRepository = $cardRepository;
    }

    public function index()
    {
        return view('game');
    }

    public function deal(Request $request)
    {
        $deckId = $request->deck_id;

        if (null !== $deckId) {
            $deck = $this->deckRepository->getDeck($deckId);
        } else {
            $deck = new Deck(md5(uniqid('', true)));
            $this->deckRepository->create($deck);
            $deck->buildCards();
        }


        $player = new Player();
        $dealer = new Dealer();

        for ($i = 0; $i < 2; $i++) {
            $card = $deck->getCard();
            $player->takeCard($card);
            $this->cardRepository->remove($card);

            $card = $deck->getCard();
            $dealer->takeCard($card);
            $this->cardRepository->remove($card);
        }

        return view('game', [
                'deck' => $deck,
                'player' => $player,
                'dealer' => $dealer
            ]
        );
    }

    public function stand(Request $request)
    {
        var_dump($request);
    }
}
