<?php

namespace src;

use src\TournamentResult;

/**
 * 大会結果リスト
 */
class TournamentResultList
{
    /** @var TournamentResult[] */
    private array $results = [];

    /**
     * @param TournamentResult[] $results
     */
    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * スコア順にソートした大会結果リストを返却
     * 第二ソートはプレイヤーID
     * @return $this
     */
    public function sortByScoreDesc(): self {

        $sortedArray = usort($this->results, function (TournamentResult $a, TournamentResult $b) {
            // スコアの降順でソート
            // スコアが同じ場合はプレイヤーIDの昇順でソート
            if ($a->getScore() === $b->getScore()) {
                return $a->getPlayerId() <=> $b->getPlayerId();
            }
            return $b->getScore() <=> $a->getScore();
        });
        return new self($sortedArray);
    }



}