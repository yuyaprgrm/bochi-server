<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/18
 * Time: 19:51
 */

namespace bochi\event;


use pocketmine\event\Cancellable;
use pocketmine\event\Event;
use pocketmine\Player;

class PlayerEntryQuestEvent extends Event implements Cancellable
{
    public function __construct(Player $player)
    {
    }
}