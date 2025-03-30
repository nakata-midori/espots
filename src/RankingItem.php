<?php

namespace src;

readonly class RankingItem
{

    public function __construct(
        private int $rank,
        private TournamentResult $tournamentResult
    )
    {
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getHandleName(): string
    {
        return $this->tournamentResult->getHandleName();
    }

    public function getPlayerId(): string
    {
        return $this->tournamentResult->getPlayerId();
    }

    public function getScore(): int
    {
        return $this->tournamentResult->getScore();
    }
}