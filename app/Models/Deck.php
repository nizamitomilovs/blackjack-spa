<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\EloquentModels\Card as CardModel;
use Illuminate\Support\Collection;
use Iterator;

class Deck
{
    /**
     * @var Collection<Card>|null
     */
    private ?Collection $cards;
    private string $id;
    private bool $active;
    private bool $complete;

    private array $suits = ['h', 's', 'd', 'c'];
    private array $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '1'];

    public function __construct(
        string     $id,
        bool       $active = true,
        bool       $complete = false,
        Collection $cards = null
    )
    {
        $this->id = $id;
        $this->active = $active;
        $this->complete = $complete;
        $this->cards = $cards ?? new Collection();
    }

    public function buildCards(): void
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $card = new CardModel();
                $card->id_hash = md5(uniqid('', true));
                $card->value = $value;
                $card->suit = $suit;
                $card->deck_id = $this->id;
                $card->save();

                $this->cards->push(
                    new Card(
                        $card->id_hash,
                        $card->value,
                        $card->suit,
                        $card->deck_id
                    )
                );
            }
        }

        $this->cards->shuffle();
    }

    public function addCards(Collection $cards): void
    {
        $this->cards = $cards;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function active(): bool
    {
        return $this->active;
    }

    public function complete(): bool
    {
        return $this->complete;
    }

    public function getCard(): Card
    {
        $card = $this->cards->first();

        $this->cards = $this->cards->filter(function ($value, $key) use ($card) {
            return $value->id() !== $card->id();
        });

        return $card;
    }
}
