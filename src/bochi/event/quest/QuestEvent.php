<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/19
 * Time: 21:03
 */

namespace bochi\event\quest;


use bochi\BochiCore;
use bochi\quest\Quest;
use bochi\QuestCore;
use pocketmine\event\Cancellable;
use pocketmine\event\Event;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\Player;

abstract class QuestEvent extends PluginEvent implements Cancellable
{

    private $player;
    private $quest;

    public function __construct(Player $player, Quest $quest)
    {
        parent::__construct(BochiCore::getInstance());
        $this->player = $player;
        $this->quest = $quest;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return Quest
     */
    public function getQuest(): Quest
    {
        return $this->quest;
    }

}