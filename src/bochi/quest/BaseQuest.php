<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/20
 * Time: 17:26
 */

namespace bochi\quest;


use bochi\BochiCore;
use bochi\QuestCore;
use bochi\task\QuestStartTask;
use bochi\task\TimeCountTask;
use bochi\utils\Display;
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
    /** @var bool */
    protected $playing;
    /** @var bool */
    protected $finished;

    public function init(Player $player)
    {
        BochiCore::getInstance()->getLogger()->info("on init.");
        $this->player = $player;
        $this->playing = false;
        $this->finished = false;
    }

    public function start() {
        BochiCore::getInstance()->getServer()->getScheduler()->scheduleDelayedTask(new QuestStartTask(BochiCore::getInstance(), $this), 20 * 3);
        BochiCore::getInstance()->getServer()->getScheduler()->scheduleRepeatingTask(
            new TimeCountTask(BochiCore::getInstance(), 3, function ($count){
                if($count > 0) {
                    $this->player->addTitle("§l§a${count}", "クエストの準備中です。", 2, 14, 2);
                } else {
                    $this->player->addTitle("§l§cMissionStart", "クエストが開始されました。", 2, 14, 2);
                }
            }), 20
        );
    }

    public function onStart()
    {
        if(!$this->player->isOnline()) {
            QuestCore::getInstance()->end($this->player, $this);
            return false;
        }
        BochiCore::getInstance()->getLogger()->info("on start.");
        $this->playing = true;
        return true;
    }

    public function onCompletion()
    {
        BochiCore::getInstance()->getLogger()->info("on completion.");
        $this->finished = true;
    }

    public function onEnd() {
        BochiCore::getInstance()->getLogger()->info("on end.");
        $this->playing = false;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return bool
     */
    public function isPlaying() : bool
    {
        return $this->playing;
    }

    /**
     * @return bool
     */
    public function hasFinished() : bool
    {
        return $this->finished;
    }


}