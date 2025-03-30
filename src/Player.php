<?php

namespace src;


/**
 * プレイヤー
 */
class Player {
    /**
     * プレイヤーID
     * @var string
     */
    private string $playerId;
    /**
     * ハンドルネーム
     * @var string
     */
    private string $handleName;

    public function __construct(string $playerId, string $handleName) {
        $this->playerId = $playerId;
        $this->handleName = $handleName;
    }

    public function getPlayerId(): string {
        return $this->playerId;
    }

    public function getHandleName(): string {
        return $this->handleName;
    }
}