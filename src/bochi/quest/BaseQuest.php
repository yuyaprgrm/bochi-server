<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/20
 * Time: 17:26
 */

namespace bochi\quest;


use pocketmine\Player;

abstract class BaseQuest implements Quest
{
    /** @var BaseQuest */
    private static $quests;

    public static function get(Player $player) {
        return BaseQuest::$quests[$player->getName()] ?? null;
    }

    public static function entry(BaseQuest $quest) {
        BaseQuest::$quests[$quest->getPlayer()->getName()] = $quest;
    }

    private $player;

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }


}