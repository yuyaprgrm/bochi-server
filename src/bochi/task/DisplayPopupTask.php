<?php
/**
 * Created by PhpStorm.
 * User: tokai
 * Date: 2018/03/18
 * Time: 18:49
 */

namespace bochi\task;


use bochi\utils\Display;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;

class DisplayPopupTask extends PluginTask
{

    private $player;
    private $display;

    public function __construct(Plugin $owner, Player $player)
    {
        parent::__construct($owner);
        $this->player = $player;
        $this->display = Display::get($player);
    }

    /**
     * Actions to execute when run
     *
     * @param int $currentTick
     *
     * @return void
     */
    public function onRun(int $currentTick)
    {
        if(!$this->player->isOnline()) { //オフライン時に
            $this->getOwner()->getServer()->getScheduler()->cancelTask($this->getTaskId());
        }
        $this->player->sendPopup($this->display->getText());
    }
}