<?php

declare(strict_types=1);

namespace App\Models;

class Player
{
    private array $cards = [];
    private bool $playerMove = true;

    public function takeCard(Card $card)
    {
        $this->cards[] = $card;
    }

    /**
     * @return array<Card>
     */
    public function getHand(): array
    {
        return $this->cards;
    }

    public function playerMove(): bool
    {
        return $this->playerMove;
    }

    public function setPlayerMove(bool $move): void
    {
        $this->playerMove = $move;
    }
}
