<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Card;
use App\Models\Deck;
use App\Models\EloquentModels\Card as CardModel;
use App\Models\EloquentModels\Deck as DeckModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CardCollection;

class DeckRepository
{
    public function create(Deck $deck): void
    {
        $deckModel = new DeckModel();
        $deckModel->id_hash = $deck->id();
        $deckModel->active = $deck->active();
        $deckModel->complete = $deck->complete();
        $deckModel->save();
    }

    public function getDeck(string $deckId): Deck
    {
        $deck = (new DeckModel())
            ->where('id_hash', $deckId)
            ->first();

        $cards = (new CardModel())
            ->where('deck_id', $deckId)
            ->get();

        $deck = $this->buildDeck($deck);
        $cards = $this->buildCards($cards);
        $deck->addCards($cards);
        return $deck;
    }

    private function buildDeck(DeckModel $deck): Deck
    {
        return new Deck(
            $deck->id_hash,
            (bool)$deck->active,
            (bool)$deck->complete,
        );
    }

    private function buildCards(Collection $cards): CardCollection
    {
        $cardCollection = new CardCollection();
        foreach ($cards as $card) {
            $cardCollection->push(
                new Card(
                    $card->id_hash,
                    $card->value,
                    $card->suit,
                    $card->deck_id
                )
            );
        }

        return $cardCollection;
    }
}
