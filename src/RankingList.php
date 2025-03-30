<?php

namespace src;

class RankingList
{
    /**
     * @param RankingItem[] $rankingList
     */
    private function __construct(readonly array $rankingList)
    {
    }

    public function getRankingList(): array
    {
        return $this->rankingList;
    }


    /**
     * @param TournamentResultList $tournamentResults
     * @return RankingList
     */
    static function make(TournamentResultList $tournamentResults): RankingList
    {
        // スコア順にソート
        $sortedResults = $tournamentResults->sortByScoreDesc();

        // ランキングリストを作成
        $rankingList = [];
        foreach ($sortedResults as $index => $result) {
            // 同一スコアの場合は同じ順位
            if ($index > 0 && $result->getScore() === $sortedResults[$index - 1]->getScore()) {
                $rank = $rankingList[$index - 1]->getRank();
            } else {
                $rank = $index + 1;
            }
            $rankingList[] = new RankingItem($rank, $result);
    }
        return new self($rankingList);
    }

    /**
     * トップNまでのランキングを取得
     * @param int $n
     * @return RankingList
     */
    public function getTopN(int $n): RankingList
    {
        $filteredRankingList = array_filter($this->rankingList, function (RankingItem $item) use ($n) {
            return $item->getRank() <= $n;
        });
        return new self($filteredRankingList);
    }

}