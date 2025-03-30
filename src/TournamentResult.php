<?php

namespace src;

require_once 'Player.php';

class TournamentResult {
    private Player $player;
    private int $score;

    public function __construct(Player $player, int $score = 0) {
        $this->player = $player;
        $this->score = $score;
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getPlayerId(): string {
        return $this->player->getPlayerId();
    }

    public function getHandleName(): string {
        return $this->player->getHandleName();
    }

    public function getScore(): int {
        return $this->score;
    }

    /**
     * 大会スコアの更新
     * @param int $newScore
     * @return $this
     */
    public function updateScore(int $newScore): self {
        if ($newScore > $this->score) {
            $this->score = $newScore;
        }
        return $this;
    }

}