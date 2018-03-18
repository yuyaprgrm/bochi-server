<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/17
 * Time: 13:06
 */

namespace bochi\database;


class DatabaseManager
{

    private $db; /** @var \mysqli */

    /**
     * DatabaseManager constructor.
     * @param array $setting データベースに関する設定
     */
    public function __construct(array $setting)
    {
        $this->db = new \mysqli($setting["host"], $setting["username"], $setting["password"], $setting["name"]);
    }

    /**
     * プレイヤーのデータを返します
     * @param string $name
     * @return [
     *  "id" => id, 固有のid(int)
     *  "name" => name, プレイヤーの名前(string)
     *  "quest_join_times" => times, クエストに参加した数(int)
     *  "level" => level, レベル
     *  "exp" => exp, 今までに手に入れた経験値
     * ]
     */
    public function getPlayerData(string $name) : ?array
    {
        $db = $this->db;
        $stmt = $db->prepare("SELECT id, quest_join_times, level, exp FROM players WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();

        $id = 0; $quest_join_times = 0;$level = 0;$exp = 0;
        $stmt->bind_result($id, $quest_join_times, $level, $exp);
        $empty = $stmt->fetch();
        $stmt->close();

        if($empty == null) {
            return null;
        }

        return [
            "id" => $id,
            "name" => $name,
            "quest_join_times" => $quest_join_times,
            "level" => $level,
            "exp" => $exp
        ];
    }

    public function createPlayerData(string $name) {
        $db = $this->db;
        $stmt = $db->prepare("INSERT INTO players(name, quest_join_times, level, exp) VALUES(?, 0, 0, 0)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->close();
    }

    public function close() {
        $this->db->close();
    }

}