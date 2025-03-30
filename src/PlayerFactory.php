<?php

namespace src;

class PlayerFactory
{

    /**
     * @return array<string ,Player> {playerId => Player}
     */
    public static function create(string $fileName): array
    {
        $players = [];
        $index =0;
        if (($handle = fopen($fileName, 'r')) !== false) {
            // 1行目はヘッダーなのでスキップ
            fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                // ２行目以降の不正データはスキップ
                if (count($data) < 2) {
                    continue; // Skip invalid lines
                }
                $playerId = trim($data[0]);
                $handleName = trim($data[1]);
                $players[$playerId] = new Player($playerId, $handleName);
            }
            fclose($handle);
        }
        return $players;

    }
}