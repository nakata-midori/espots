<?php

namespace src;

class TounamentResultListFactory
{

    /**
     * @param string $fileName
     * @param array<string, Player> $entryPlayerArray
     * @return TournamentResultList
     */
    public static function create(string $fileName, array $entryPlayerArray): TournamentResultList
    {
        /** @var $tournamentResulArray TournamentResult[] */
        $tournamentResulArray = [];
        if (($handle = fopen($fileName, 'r')) !== false) {
            // 1行目はヘッダーなのでスキップ
            fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                if (count($data) < 3) {
                    continue; // Skip invalid lines
                }
                $createTimeStamp = trim($data[0]);
                $playerId = trim($data[1]);
                $score = (int)trim($data[2]);
                if (!isset($entryPlayerArray[$playerId])) {
                    continue; // Skip players not in the entry list
                }
                // $playerIdが存在しなければ新規作成して代入、存在する場合はスコアが大きい方を代入
                if (isset($tournamentResulArray[$playerId])) {
                    /** @var TournamentResult $tournamentResult */
                    $tournamentResulArray[$playerId] = $tournamentResulArray[$playerId]->updateScore($score);
                } else {
                    // $playerIdが存在しなければ新規作成して代入
                    $tournamentResulArray[$playerId] = new TournamentResult($entryPlayerArray[$playerId], $score);
                }
            }
            fclose($handle);
        }
        return new TournamentResultList($tournamentResulArray);
    }

}