<?php

require_once 'src/TournamentResult.php';
require_once 'src/TournamentResultList.php';
require_once 'src/PlayerFactory.php';
require_once 'src/TounamentResultListFactory.php';
require_once 'src/RankingList.php';

use src\PlayerFactory;
use src\RankingList;
use src\TounamentResultListFactory;

// コマンドライン引数の取得
if ($argc < 3) {
    fwrite(STDERR, "Usage: php run.php <entry_csv_path> <log_csv_path>\n");
    exit(1);
}

$entryCsvPath = $argv[1];
$logCsvPath = $argv[2];

$entryPlayerArray = PlayerFactory::create($entryCsvPath);

// プレイログから大会エントリープレイヤーのスコア一覧を作成
$tournamentResultList = TounamentResultListFactory::create($logCsvPath, $entryPlayerArray);

//上位１０位のランキングリストの生成
$rankingList = (RankingList::make($tournamentResultList))->getTopN(10);

// ランキングリストの出力
echo "Rank,Handle Name,Player ID,Score\n";
foreach ($rankingList->getRankingList() as  $rankingItem) {
    echo $rankingItem->getRank() . ',' .
        $rankingItem->getHandleName() . ',' .
        $rankingItem->getPlayerId() . ',' .
        $rankingItem->getScore() . "\n";
}