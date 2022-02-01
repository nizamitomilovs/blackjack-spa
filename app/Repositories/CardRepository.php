<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Card;
use App\Models\EloquentModels\Card as CardEloquentModel;


class CardRepository
{
    public function save(Card $card)
    {
        $cardEloquentModel = new CardEloquentModel();

    }

    public function create(Card $card): void
    {
        $cardEloquentModel = new CardEloquentModel();
        $cardEloquentModel->id_hash = $card->id();
        $cardEloquentModel->value = $card->value();
        $cardEloquentModel->suit = $card->suit();
        $cardEloquentModel->deck_id = $card->deckId();
        $cardEloquentModel->save();
    }

    public function remove(Card $card): void
    {
        (new CardEloquentModel())
            ->where('id_hash', $card->id())
            ->delete();
    }
}
