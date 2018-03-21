<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/20
 * Time: 17:26
 */

namespace bochi\quest;


use bochi\BochiCore;
use bochi\task\QuestStartTask;
use bochi\task\TimeCountTask;
use pocketmine\Player;

abstract class BaseQuest implements Quest
{
    /** @var BaseQuest */
    private static $quests;

    public static function get(Player $player) : ?BaseQuest {
        return BaseQuest::$quests[$player->getName()] ?? null;
    }

    public static function entry(BaseQuest $quest) {
        BaseQuest::$quests[$quest->getPlayer()->getName()] = $quest;
    }

    /** @var Player */
    protected $player;

    public function init(Player $player)
    {
        $this->player = $player;
    }

    public function start() {
        BochiCore::getInstance()->getServer()->getScheduler()->scheduleDelayedTask(new QuestStartTask(BochiCore::getInstance(), $this), 20 * 5);
        BochiCore::getInstance()->getServer()->getScheduler()->scheduleRepeatingTask(
            new TimeCountTask(BochiCore::getInstance(), 5, function ($count){
                $this->player->addTitle("§l§a${count}", "クエストの準備中です。", 2, 14, 2);
            }), 20
        );
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }


}