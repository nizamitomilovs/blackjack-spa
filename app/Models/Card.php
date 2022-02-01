<?php

declare(strict_types=1);

namespace App\Models;

class Card
{
    private string $id;
    private string $value;
    private string $suit;
    private string $deckId;

    public function __construct(string $id, string $value, string $suit, string $deckId)
    {
        $this->id = $id;
        $this->suit = $suit;
        $this->value = $value;
        $this->deckId = $deckId;
    }

    public function deckId(): string
    {
        return $this->deckId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function suit(): string
    {
        return $this->suit;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->suit . $this->value;
    }
}
